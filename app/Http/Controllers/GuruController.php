<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Kriteria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Siswa;
use App\Models\Kelas;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\SiswaImport;
use App\Models\PerbandinganKriteria;
use App\Models\Alternatif;
use App\Models\PerbandinganAlternatif;
use App\Models\HasilAHP;
use Barryvdh\DomPDF\Facade\Pdf;

class GuruController extends Controller
{

    public function dashboard()
    {
        $jumlahGuru = User::where('role', 'guru')->count();
        $jumlahSiswa = Siswa::count();
        $jumlahKelas = Kelas::count();
        $jumlahKriteria = Kriteria::count();
        $jumlahAlternatif = Alternatif::count();
        return view('guru.dashboard', compact(
            'jumlahGuru',
            'jumlahSiswa',
            'jumlahKelas',
            'jumlahKriteria',
            'jumlahAlternatif'
        ));
    }
    public function edit(Request $request)
    {
        return view('profile.guru', [
            'user' => $request->user(),
        ]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email'],
        ]);

        $user = $request->user();
        $user->update($request->only('name', 'email'));

        return redirect()->route('guru.profile.edit')->with('success', 'Profil berhasil diperbarui');
    }

    public function destroy(Request $request)
    {
        $user = $request->user();
        $user->delete();

        return redirect('/')->with('success', 'Akun berhasil dihapus');
    }

        public function hasilAHP()
    {
        $hasil = HasilAHP::with('kriteria')->get();
        return view('guru.kriteria.hasil-ahp', compact('hasil'));
    }
    public function indexSiswa()
    {
        $siswas = Siswa::with('kelas')->get();
        return view('guru.index-siswa', compact('siswas'));
    }
     public function indexAlternatif()
    {
        $alternatifs = Alternatif::all();
        return view('guru.alternatif.index', compact('alternatifs'));
    }

    
public function showSiswa($id)
{
    // Ambil data siswa beserta relasi kelas
    $siswa = Siswa::with('kelas')->findOrFail($id);

    // Bisa juga menambahkan relasi lain jika ada, misal nilai, kehadiran, dll
    // $siswa = Siswa::with(['kelas', 'nilai', 'kehadiran'])->findOrFail($id);

    return view('guru.show-siswa', compact('siswa'));
}

public function indexKriteria()
    {
        $kriterias = Kriteria::all();
        return view('guru.kriteria.index-kriteria', compact('kriterias'));
    }

public function indexPerbandinganAlternatif()
    {
        $siswas = Siswa::all();
        return view('guru.perbandingan_alternatif.index', compact('siswas'));
    }

    // Form input perbandingan alternatif per siswa
   public function createPerbandinganAlternatif($siswa_id)
{
    $siswa = Siswa::findOrFail($siswa_id);
    $kriterias = Kriteria::all();
    $alternatifs = Alternatif::all();

    // Ambil perbandingan yang sudah tersimpan
    $existingPerbandingan = PerbandinganAlternatif::where('siswa_id', $siswa_id)->get();

    // Membuat array untuk mudah diakses di form: [kriteria_id][alt1_id][alt2_id] = data
    $perbandinganData = [];
    foreach ($existingPerbandingan as $p) {
        $perbandinganData[$p->kriteria_id][$p->alternatif1_id][$p->alternatif2_id] = [
            'nilai' => $p->nilai,
            'pilihan' => $p->pilihan,
            'alasan' => $p->alasan,
        ];
    }

    return view('guru.perbandingan_alternatif.create', compact(
        'siswa', 'kriterias', 'alternatifs', 'perbandinganData'
    ));
}


    // Simpan hasil perbandingan alternatif
   public function storePerbandinganAlternatif(Request $request, $siswa_id)
{
    $siswa = Siswa::findOrFail($siswa_id);

    // Pastikan ada data nilai
    if (!$request->has('nilai')) {
        return back()->with('error', 'Tidak ada data perbandingan yang dikirim.');
    }

    foreach ($request->nilai as $kriteria_id => $alt1s) {
        foreach ($alt1s as $alt1_id => $alt2s) {
            foreach ($alt2s as $alt2_id => $nilai) {
                // ambil tambahan data
                $pilihan = $request->pilihan[$kriteria_id][$alt1_id][$alt2_id] ?? null;
                $alasan  = $request->alasan[$kriteria_id][$alt1_id][$alt2_id] ?? null;

                // hapus dulu data lama agar tidak dobel
                PerbandinganAlternatif::where('siswa_id', $siswa_id)
                    ->where('kriteria_id', $kriteria_id)
                    ->where('alternatif1_id', $alt1_id)
                    ->where('alternatif2_id', $alt2_id)
                    ->delete();

                // simpan arah normal
                PerbandinganAlternatif::create([
                    'siswa_id'       => $siswa_id,
                    'kriteria_id'    => $kriteria_id,
                    'alternatif1_id' => $alt1_id,
                    'alternatif2_id' => $alt2_id,
                    'nilai'          => $nilai,
                    'pilihan'        => $pilihan,
                    'alasan'         => $alasan,
                ]);

                // simpan arah kebalikan
                PerbandinganAlternatif::create([
                    'siswa_id'       => $siswa_id,
                    'kriteria_id'    => $kriteria_id,
                    'alternatif1_id' => $alt2_id,
                    'alternatif2_id' => $alt1_id,
                    'nilai'          => (is_numeric($nilai) && $nilai != 0) ? 1 / $nilai : 0,
                    'pilihan'        => ($pilihan == $alt1_id) ? $alt2_id : $alt1_id,
                    'alasan'         => $alasan,
                ]);
            }
        }
    }

   return redirect()->route('guru.perbandingan_alternatif.show', $siswa_id)
    ->with('success', 'Perbandingan alternatif berhasil disimpan!');



}
public function showPerbandinganAlternatif($siswa_id)
    {
        $siswa = Siswa::findOrFail($siswa_id);
        $perbandingans = PerbandinganAlternatif::where('siswa_id', $siswa_id)->get();
        $kriterias = Kriteria::all();
        $alternatifs = Alternatif::all();

        $hasilAHP = [];

        foreach ($kriterias as $kriteria) {
            $n = $alternatifs->count();

            // Inisialisasi matriks simetris
            $matrix = [];
            foreach ($alternatifs as $i) {
                foreach ($alternatifs as $j) {
                    $matrix[$i->id][$j->id] = ($i->id === $j->id) ? 1 : null;
                }
            }

            // Isi matriks dari perbandingan
            $perbandinganKriteria = $perbandingans->where('kriteria_id', $kriteria->id);
            foreach ($perbandinganKriteria as $p) {
                $a = $p->alternatif1_id;
                $b = $p->alternatif2_id;
                $nilai = $p->nilai;

               if ($nilai == 0) {
    $nilai = 0.01; // default kecil untuk menghindari division by zero
}

if ($p->pilihan == $a) {
    $matrix[$a][$b] = $nilai;
    $matrix[$b][$a] = 1 / $nilai;
} else {
    $matrix[$a][$b] = 1 / $nilai;
    $matrix[$b][$a] = $nilai;
}
            }

            // Ambil daftar ID alternatif
            $altIds = $alternatifs->pluck('id')->toArray();

            // Hitung geometric mean
$geomMeans = [];
foreach ($matrix as $i_id => $row) {
    $rowValues = array_map(fn($v) => $v ?? 1, $row); // null diganti 1
    $geomMeans[] = pow(array_product($rowValues), 1 / $n);
}

// Buat bobot keyed by ID alternatif
$sumGeom = array_sum($geomMeans);
$bobot = [];

if ($sumGeom == 0) {
    foreach ($altIds as $id) {
        $bobot[$id] = 1 / count($altIds); // bobot sama rata
    }
} else {
    foreach ($altIds as $index => $id) {
        $bobot[$id] = $geomMeans[$index] / $sumGeom;
    }
}

            // Hitung Consistency Ratio (CR)
            $lambdaMax = 0;
foreach ($matrix as $i_id => $row) {
    $rowSum = 0;
    foreach ($row as $j_id => $value) {
        $rowSum += $value * $bobot[$j_id];
    }
    $lambdaMax += ($bobot[$i_id] != 0) ? ($rowSum / $bobot[$i_id]) : 0;
}

$lambdaMax /= $n;

$CI = ($n > 1) ? ($lambdaMax - $n) / ($n - 1) : 0;
$RI_table = [0,0,0.58,0.9,1.12,1.24,1.32,1.41,1.45,1.49];
$RI = $RI_table[$n] ?? 1.49;
$CR = ($RI != 0) ? $CI / $RI : 0;


            // Simpan hasil
            $hasilAHP[$kriteria->id] = [
                'bobot' => $bobot,
                'CR' => $CR,
            ];
        }

        return view('guru.perbandingan_alternatif.show', compact(
            'siswa', 'perbandingans', 'kriterias', 'alternatifs', 'hasilAHP'
        ));
    }

    public function cetakPerbandingan($siswa_id)
{
    $siswa = Siswa::findOrFail($siswa_id);
    $perbandingans = PerbandinganAlternatif::where('siswa_id', $siswa_id)->get();
    $kriterias = Kriteria::all();
    $alternatifs = Alternatif::all();

    $hasilAHP = [];

    foreach ($kriterias as $kriteria) {
        $n = $alternatifs->count();
        $matrix = [];
        foreach ($alternatifs as $i) {
            foreach ($alternatifs as $j) {
                $matrix[$i->id][$j->id] = ($i->id === $j->id) ? 1 : null;
            }
        }

        $perbandinganKriteria = $perbandingans->where('kriteria_id', $kriteria->id);
        foreach ($perbandinganKriteria as $p) {
            $a = $p->alternatif1_id;
            $b = $p->alternatif2_id;
            $nilai = $p->nilai ?: 0.01;

            if ($p->pilihan == $a) {
                $matrix[$a][$b] = $nilai;
                $matrix[$b][$a] = 1 / $nilai;
            } else {
                $matrix[$a][$b] = 1 / $nilai;
                $matrix[$b][$a] = $nilai;
            }
        }

        $altIds = $alternatifs->pluck('id')->toArray();
        $geomMeans = [];
        foreach ($matrix as $i_id => $row) {
            $geomMeans[] = pow(array_product($row), 1 / $n);
        }

        $sumGeom = array_sum($geomMeans);
        $bobot = [];
        foreach ($altIds as $index => $id) {
            $bobot[$id] = $geomMeans[$index] / $sumGeom;
        }

        $lambdaMax = 0;
        foreach ($matrix as $i_id => $row) {
            $rowSum = 0;
            foreach ($row as $j_id => $value) {
                $rowSum += $value * $bobot[$j_id];
            }
            $lambdaMax += ($bobot[$i_id] != 0) ? ($rowSum / $bobot[$i_id]) : 0;
        }
        $lambdaMax /= $n;
        $CI = ($n > 1) ? ($lambdaMax - $n) / ($n - 1) : 0;
        $RI_table = [0,0,0.58,0.9,1.12,1.24,1.32,1.41,1.45,1.49];
        $RI = $RI_table[$n] ?? 1.49;
        $CR = ($RI != 0) ? $CI / $RI : 0;

        $hasilAHP[$kriteria->id] = [
            'bobot' => $bobot,
            'CR' => $CR,
        ];
    }

    $pdf = Pdf::loadView('guru.perbandingan_alternatif.cetak_pdf', compact(
        'siswa', 'perbandingans', 'kriterias', 'alternatifs', 'hasilAHP'
    ));

    return $pdf->stream("laporan_perbandingan_{$siswa->nama}.pdf");
}

}
