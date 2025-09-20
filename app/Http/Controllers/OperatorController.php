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



class OperatorController extends Controller
{
    // Dashboard
   public function dashboard()
{
    $jumlahGuru = User::where('role', 'guru')->count();
    $jumlahSiswa = Siswa::count();
    $jumlahKelas = Kelas::count();
    $jumlahKriteria = Kriteria::count();
    $jumlahAlternatif = Alternatif::count();

    return view('operator.dashboard', compact('jumlahGuru', 'jumlahSiswa', 'jumlahKelas', 'jumlahKriteria', 'jumlahAlternatif'));
}
 public function edit(Request $request)
    {
        return view('profile.operator', [
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

        return redirect()->route('operator.profile.edit')->with('success', 'Profil berhasil diperbarui');
    }

    public function destroy(Request $request)
    {
        $user = $request->user();
        $user->delete();

        return redirect('/')->with('success', 'Akun berhasil dihapus');
    }

    // ===== CRUD Guru =====
    public function createGuru()
    {
        return view('operator.create-guru');
    }

    public function storeGuru(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'guru',
        ]);

        return redirect()->route('operator.guru.index')->with('success', 'Guru berhasil ditambahkan.');
    }

    public function indexGuru()
    {
        $gurus = User::where('role', 'guru')->get();
        return view('operator.index-guru', compact('gurus'));
    }

    public function editGuru($id)
    {
        $guru = User::findOrFail($id);
        return view('operator.edit-guru', compact('guru'));
    }

    public function updateGuru(Request $request, $id)
    {
        $guru = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $guru->id,
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        $guru->name = $request->name;
        $guru->email = $request->email;
        if ($request->password) {
            $guru->password = Hash::make($request->password);
        }
        $guru->save();

        return redirect()->route('operator.guru.index')->with('success', 'Guru berhasil diperbarui.');
    }

    public function destroyGuru($id)
    {
        $guru = User::findOrFail($id);
        $guru->delete();

        return redirect()->route('operator.guru.index')->with('success', 'Guru berhasil dihapus.');
    }

    // ===== CRUD Kriteria =====
    public function createKriteria()
    {
        return view('operator.kriteria.create-kriteria');
    }

  public function storeKriteria(Request $request)
{
    $request->validate([
        'nama' => 'required|string|max:255',
    ]);

    // generate kode otomatis berdasarkan data terakhir
    $lastKriteria = Kriteria::orderBy('id', 'desc')->first();
    $nextNumber = $lastKriteria ? $lastKriteria->id + 1 : 1;
    $kode = 'C' . str_pad($nextNumber, 2, '0', STR_PAD_LEFT); // misal K01, K02

    Kriteria::create([
        'nama' => $request->nama,
        'kode' => $kode,
    ]);

    return redirect()->route('operator.kriteria.index')->with('success', 'Kriteria berhasil ditambahkan.');
}


    public function indexKriteria()
    {
        $kriterias = Kriteria::all();
        return view('operator.kriteria.index-kriteria', compact('kriterias'));
    }

    public function editKriteria($id)
    {
        $kriteria = Kriteria::findOrFail($id);
        return view('operator.kriteria.edit-kriteria', compact('kriteria'));
    }

  public function updateKriteria(Request $request, $id)
{
    $kriteria = Kriteria::findOrFail($id);

    $request->validate([
        'nama' => 'required|string|max:255',
        // kode tidak divalidasi karena tidak boleh diubah
    ]);

    $kriteria->nama = $request->nama;
    // kode tidak diubah
    $kriteria->save();

    return redirect()->route('operator.kriteria.index')
        ->with('success', 'Kriteria berhasil diperbarui.');
}


    public function destroyKriteria($id)
    {
        $kriteria = Kriteria::findOrFail($id);
        $kriteria->delete();

        return redirect()->route('operator.kriteria.index')->with('success', 'Kriteria berhasil dihapus.');
    }

// Seleksi AHP
 // Tampilkan daftar kriteria & form perbandingan
    public function kriteriaPerbandingan(Request $request)
{
    $kriteria = Kriteria::orderBy('id')->get();
    return view('operator.kriteria.perbandingan', compact('kriteria'));
}


    // Simpan perbandingan kriteria


// Hasil perhitungan AHP
public function hasilAHP()
{
    $kriteria = Kriteria::all();
    $n = $kriteria->count();

    $bobotKriteria = [];

    if ($n > 0) {
        // Matriks perbandingan
        $matrix = array_fill(0, $n, array_fill(0, $n, 1));

        foreach ($kriteria as $i => $k1) {
            foreach ($kriteria as $j => $k2) {
                if ($i != $j) {
                    $nilai = PerbandinganKriteria::where('kriteria1_id', $k1->id)
                        ->where('kriteria2_id', $k2->id)
                        ->value('nilai') ?? 1;
                    $matrix[$i][$j] = $nilai;
                }
            }
        }

        // Hitung bobot (geometric mean)
        $geomMeans = [];
        foreach ($matrix as $row) {
            $geomMeans[] = pow(array_product($row), 1 / $n);
        }

        $sumGeom = array_sum($geomMeans);
        $weights = array_map(fn($gm) => $gm / $sumGeom, $geomMeans);

        foreach ($kriteria as $i => $k) {
            $bobotKriteria[] = [
                'kriteria' => $k->nama,
                'bobot' => round($weights[$i], 4)
            ];
        }
    }

    return view('operator.kriteria.hasil-ahp', compact('kriteria', 'bobotKriteria'));
}

public function hitungAHP(Request $request)
{
    // 1. Simpan perbandingan
    $this->simpanPerbandingan($request);

    // 2. Redirect ke hasil AHP
    return redirect()->route('operator.kriteria.hasilAHP')
        ->with('success', 'Perhitungan AHP berhasil dilakukan.');
}

public function simpanPerbandingan(Request $request)
{
    $listKriteria = Kriteria::all();

    // Hapus perbandingan lama
    PerbandinganKriteria::truncate();

  foreach ($listKriteria as $i => $k1) {
    foreach ($listKriteria as $j => $k2) {
        if ($i < $j) {
            $field = "kriteria_{$k1->id}_vs_{$k2->id}";
            $nilai = $request->input($field, 1);

            // Update atau buat baru
            PerbandinganKriteria::updateOrCreate(
                ['kriteria1_id' => $k1->id, 'kriteria2_id' => $k2->id],
                ['nilai' => $nilai]
            );

            // Update atau buat nilai kebalikannya
            PerbandinganKriteria::updateOrCreate(
                ['kriteria1_id' => $k2->id, 'kriteria2_id' => $k1->id],
                ['nilai' => 1 / $nilai]
            );
        }
    }
}


    return redirect()->route('operator.kriteria.perbandingan.index')
        ->with('success', 'Data perbandingan berhasil disimpan.');
}







    // CRUD Siswa

    // ================== CRUD SISWA ==================

    public function indexSiswa()
    {
        $siswas = Siswa::with('kelas')->get();
        return view('operator.index-siswa', compact('siswas'));
    }

    public function createSiswa()
    {
        $kelas = Kelas::all();
        return view('operator.create-siswa', compact('kelas'));
    }

    public function storeSiswa(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'nis' => 'required|string|unique:siswas,nis',
            'kelas_id' => 'required|exists:kelas,id',
        ]);

        Siswa::create($request->all());

        return redirect()->route('operator.siswa.index')->with('success', 'Data siswa berhasil ditambahkan.');
    }

    public function editSiswa($id)
    {
        $siswa = Siswa::findOrFail($id);
        $kelas = Kelas::all();
        return view('operator.edit-siswa', compact('siswa', 'kelas'));
    }

    public function updateSiswa(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'nis' => 'required|string|unique:siswas,nis,' . $id,
            'kelas_id' => 'required|exists:kelas,id',
        ]);

        $siswa = Siswa::findOrFail($id);
        $siswa->update($request->all());

        return redirect()->route('operator.siswa.index')->with('success', 'Data siswa berhasil diperbarui.');
    }

    public function destroySiswa($id)
    {
        $siswa = Siswa::findOrFail($id);
        $siswa->delete();

        return redirect()->route('operator.siswa.index')->with('success', 'Data siswa berhasil dihapus.');
    }
    // Controller OperatorController.php

public function showSiswa($id)
{
    // Ambil data siswa beserta relasi kelas
    $siswa = Siswa::with('kelas')->findOrFail($id);

    // Bisa juga menambahkan relasi lain jika ada, misal nilai, kehadiran, dll
    // $siswa = Siswa::with(['kelas', 'nilai', 'kehadiran'])->findOrFail($id);

    return view('operator.show-siswa', compact('siswa'));
}


 public function importSiswa(Request $request)
{
    $request->validate([
        'file' => 'required|mimes:xlsx,xls,csv',
    ]);

    $import = new SiswaImport;
    Excel::import($import, $request->file('file'));

    $message = 'Import selesai.';

    if (!empty($import->gagal)) {
        $message .= "\nBaris gagal:\n" . implode("\n", $import->gagal);
    } else {
        $message .= ' Semua data berhasil diimport.';
    }

    return redirect()->route('operator.siswa.index')->with('alert', $message);
}


    // ================== CRUD KELAS ==================

    public function indexKelas()
    {
        $kelas = Kelas::all();
        return view('operator.index-kelas', compact('kelas'));
    }

    public function createKelas()
    {
        return view('operator.create-kelas');
    }

    public function storeKelas(Request $request)
    {
        $request->validate([
            'nama_kelas' => 'required|string|max:255',

        ]);

        Kelas::create($request->all());

        return redirect()->route('operator.kelas.index')->with('success', 'Data kelas berhasil ditambahkan.');
    }

    public function editKelas($id)
    {
        $kelas = Kelas::findOrFail($id);
        return view('operator.edit-kelas', compact('kelas'));
    }

    public function updateKelas(Request $request, $id)
    {
        $request->validate([
            'nama_kelas' => 'required|string|max:255',

        ]);

        $kelas = Kelas::findOrFail($id);
        $kelas->update($request->all());

        return redirect()->route('operator.kelas.index')->with('success', 'Data kelas berhasil diperbarui.');
    }

    public function destroyKelas($id)
    {
        $kelas = Kelas::findOrFail($id);
        $kelas->delete();

        return redirect()->route('operator.kelas.index')->with('success', 'Data kelas berhasil dihapus.');
    }
    // ================================
    // CRUD ALTERNATIF
    // ================================
  // ================================
    // CRUD ALTERNATIF
    // ================================
    public function indexAlternatif()
    {
        $alternatifs = Alternatif::all();
        return view('operator.alternatif.index', compact('alternatifs'));
    }

    public function createAlternatif()
    {
        return view('operator.alternatif.create');
    }

   public function storeAlternatif(Request $request)
{
    $request->validate([
        'nama' => 'required|string|max:255',
    ]);

    // Hitung jumlah data alternatif yang sudah ada
    $count = Alternatif::count() + 1;
    $kode = 'A' . str_pad($count, 2, '0', STR_PAD_LEFT);

    // Simpan data
    Alternatif::create([
        'nama' => $request->nama,
        'kode' => $kode
    ]);

    return redirect()->route('alternatif.index')
        ->with('success', 'Alternatif berhasil ditambahkan');
}


    public function editAlternatif($id)
    {
        $alternatif = Alternatif::findOrFail($id);
        return view('operator.alternatif.edit', compact('alternatif'));
    }

   public function updateAlternatif(Request $request, $id)
{
    $alternatif = Alternatif::findOrFail($id);

    $request->validate([
        'nama' => 'required|string|max:255',
    ]);

    $alternatif->update([
        'nama' => $request->nama
        // kode jangan diubah
    ]);

    return redirect()->route('alternatif.index')
        ->with('success', 'Alternatif berhasil diperbarui');
}


    public function destroyAlternatif($id)
    {
        Alternatif::findOrFail($id)->delete();
        return redirect()->route('alternatif.index')->with('success', 'Alternatif berhasil dihapus');
    }


     // Tampilkan daftar siswa
    public function indexPerbandinganAlternatif()
    {
        $siswas = Siswa::all();
        return view('operator.perbandingan_alternatif.index', compact('siswas'));
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

    return view('operator.perbandingan_alternatif.create', compact(
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

   return redirect()->route('perbandingan_alternatif.show', $siswa_id)
    ->with('success', 'Perbandingan alternatif berhasil disimpan!');


}


    // Lihat semua perbandingan alternatif + hitung bobot AHP
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

        return view('operator.perbandingan_alternatif.show', compact(
            'siswa', 'perbandingans', 'kriterias', 'alternatifs', 'hasilAHP'
        ));
    }

 public function indexHasilSiswa()
{
    $siswas = Siswa::all();
    $kriterias = Kriteria::all();
    $alternatifs = Alternatif::all();

    // Inisialisasi: semua alternatif ada, meskipun kosong
    $siswaPerAlternatif = [];
    foreach ($alternatifs as $alt) {
        $siswaPerAlternatif[$alt->nama] = [];
    }

    $totalScoreAll = []; // untuk chart
    $nilaiPerSiswa = []; // semua bobot alternatif per siswa

    foreach ($siswas as $siswa) {
        $perbandingans = PerbandinganAlternatif::where('siswa_id', $siswa->id)->get();
        $totalScoreAlternatif = [];

        foreach ($kriterias as $kriteria) {
            $n = $alternatifs->count();
            if ($n == 0) continue;

            // inisialisasi matrix
            $matrix = [];
            foreach ($alternatifs as $i) {
                foreach ($alternatifs as $j) {
                    $matrix[$i->id][$j->id] = ($i->id === $j->id) ? 1 : 0.01;
                }
            }

            $perbandinganKriteria = $perbandingans->where('kriteria_id', $kriteria->id);
            if ($perbandinganKriteria->count() == 0) {
                $geomMeans = array_fill(0, $n, 1);
            } else {
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

                // hitung geometric mean
                $geomMeans = [];
                foreach ($matrix as $i_id => $row) {
                    $geomMeans[] = pow(array_product($row), 1 / $n);
                }
            }

            $sumGeom = array_sum($geomMeans);
            if ($sumGeom == 0) $sumGeom = 0.0001;

            foreach ($alternatifs as $index => $alt) {
                $bobot = $geomMeans[$index] / $sumGeom;
                if (!isset($totalScoreAlternatif[$alt->id])) {
                    $totalScoreAlternatif[$alt->id] = 0;
                }
                $totalScoreAlternatif[$alt->id] += $bobot;
            }
        }

        if (!empty($totalScoreAlternatif)) {
            // simpan nilai semua alternatif per siswa
            $nilaiPerSiswa[$siswa->id] = $totalScoreAlternatif;

            // cari alternatif terbaik
            $maxScore = max($totalScoreAlternatif);
            $alternatifTerbaikId = array_search($maxScore, $totalScoreAlternatif);
            $alternatifTerbaik = Alternatif::find($alternatifTerbaikId);

            if ($alternatifTerbaik) {
                $siswaPerAlternatif[$alternatifTerbaik->nama][] = $siswa;
            }

            // simpan total untuk chart
            foreach ($totalScoreAlternatif as $altId => $score) {
                if (!isset($totalScoreAll[$altId])) {
                    $totalScoreAll[$altId] = 0;
                }
                $totalScoreAll[$altId] += $score;
            }
        }
    }

    // Chart hanya untuk alternatif dengan skor > 0
    $chartLabels = [];
    $chartData = [];
    foreach ($totalScoreAll as $altId => $score) {
        if ($score > 0) {
            $alt = Alternatif::find($altId);
            $chartLabels[] = $alt->nama;
            $chartData[] = $score;
        }
    }

    return view('operator.perbandingan_alternatif.hasil_semua', compact(
        'siswas', 'siswaPerAlternatif', 'nilaiPerSiswa', 'alternatifs', 'chartLabels', 'chartData'
    ));
}


    // Cetak PDF hasil perbandingan alternatif untuk satu siswa


public function cetakPdfHasilSiswa()
{
    $siswas = Siswa::all();
    $kriterias = Kriteria::all();
    $alternatifs = Alternatif::all();

    // Inisialisasi: semua alternatif ada, walaupun kosong
    $siswaPerAlternatif = [];
    foreach ($alternatifs as $alt) {
        $siswaPerAlternatif[$alt->nama] = [];
    }

    foreach ($siswas as $siswa) {
        $perbandingans = PerbandinganAlternatif::where('siswa_id', $siswa->id)->get();
        $totalScoreAlternatif = [];

        foreach ($kriterias as $kriteria) {
            $n = $alternatifs->count();
            if ($n == 0) continue;

            $matrix = [];
            foreach ($alternatifs as $i) {
                foreach ($alternatifs as $j) {
                    $matrix[$i->id][$j->id] = ($i->id === $j->id) ? 1 : 0.01;
                }
            }

            $perbandinganKriteria = $perbandingans->where('kriteria_id', $kriteria->id);
            if ($perbandinganKriteria->count() == 0) {
                $geomMeans = array_fill(0, $n, 1);
            } else {
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

                $geomMeans = [];
                foreach ($matrix as $i_id => $row) {
                    $geomMeans[] = pow(array_product($row), 1 / $n);
                }
            }

            $sumGeom = array_sum($geomMeans);
            if ($sumGeom == 0) $sumGeom = 0.0001;

            foreach ($alternatifs as $index => $alt) {
                $bobot = $geomMeans[$index] / $sumGeom;
                if (!isset($totalScoreAlternatif[$alt->id])) {
                    $totalScoreAlternatif[$alt->id] = 0;
                }
                $totalScoreAlternatif[$alt->id] += $bobot;
            }
        }

        if (!empty($totalScoreAlternatif)) {
            $maxScore = max($totalScoreAlternatif);
            $alternatifTerbaikId = array_search($maxScore, $totalScoreAlternatif);
            $alternatifTerbaik = Alternatif::find($alternatifTerbaikId);

            if ($alternatifTerbaik) {
                $siswaPerAlternatif[$alternatifTerbaik->nama][] = $siswa;
            }
        }
    }

    $pdf = PDF::loadView('operator.perbandingan_alternatif.hasil_pdf', compact(
        'siswaPerAlternatif', 'alternatifs'
    ));

    return response($pdf->stream('hasil_perbandingan_siswa.pdf'))
        ->header('Content-Type', 'application/pdf');
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

    $pdf = Pdf::loadView('operator.perbandingan_alternatif.cetak_pdf', compact(
        'siswa', 'perbandingans', 'kriterias', 'alternatifs', 'hasilAHP'
    ));

    return $pdf->stream("laporan_perbandingan_{$siswa->nama}.pdf");
}

}




