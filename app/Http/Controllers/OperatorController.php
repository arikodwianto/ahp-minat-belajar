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

use App\Models\HasilAHP;



class OperatorController extends Controller
{
    // Dashboard
   public function dashboard()
{
    $jumlahGuru = User::where('role', 'guru')->count();
    $jumlahSiswa = Siswa::count();
    $jumlahKelas = Kelas::count();
    $jumlahKriteria = Kriteria::count();

    return view('operator.dashboard', compact('jumlahGuru', 'jumlahSiswa', 'jumlahKelas', 'jumlahKriteria'));
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

                // Simpan nilai perbandingan
                PerbandinganKriteria::create([
                    'kriteria1_id' => $k1->id,
                    'kriteria2_id' => $k2->id,
                    'nilai' => $nilai
                ]);

                // Simpan nilai kebalikannya
                PerbandinganKriteria::create([
                    'kriteria1_id' => $k2->id,
                    'kriteria2_id' => $k1->id,
                    'nilai' => 1 / $nilai
                ]);
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
}



