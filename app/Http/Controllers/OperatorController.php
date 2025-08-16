<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Kriteria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Siswa;


class OperatorController extends Controller
{
    // Dashboard
    public function dashboard()
    {
        return view('operator.dashboard');
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
        return view('operator.create-kriteria');
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
        return view('operator.index-kriteria', compact('kriterias'));
    }

    public function editKriteria($id)
    {
        $kriteria = Kriteria::findOrFail($id);
        return view('operator.edit-kriteria', compact('kriteria'));
    }

    public function updateKriteria(Request $request, $id)
    {
        $kriteria = Kriteria::findOrFail($id);

        $request->validate([
            'nama' => 'required|string|max:255',
            'kode' => 'required|string|max:10|unique:kriterias,kode,' . $kriteria->id,
        ]);

        $kriteria->nama = $request->nama;
        $kriteria->kode = $request->kode;
        $kriteria->save();

        return redirect()->route('operator.kriteria.index')->with('success', 'Kriteria berhasil diperbarui.');
    }

    public function destroyKriteria($id)
    {
        $kriteria = Kriteria::findOrFail($id);
        $kriteria->delete();

        return redirect()->route('operator.kriteria.index')->with('success', 'Kriteria berhasil dihapus.');
    }
    // CRUD Siswa
public function indexSiswa()
{
    $siswas = Siswa::all();
    return view('operator.index-siswa', compact('siswas'));
}

public function createSiswa()
{
    return view('operator.create-siswa');
}

public function storeSiswa(Request $request)
{
    $request->validate([
        'nama' => 'required|string|max:255',
        'nis' => 'required|string|unique:siswas,nis',
        'jenis_kelamin' => 'required',
        'tanggal_lahir' => 'required|date',
        'tempat_lahir' => 'required|string|max:255',
        'agama' => 'required|string|max:50',
        'alamat' => 'required|string|max:500',
    ]);

    Siswa::create($request->only([
        'nama',
        'nis',
        'jenis_kelamin',
        'tanggal_lahir',
        'tempat_lahir',
        'agama',
        'alamat',
        'telepon',
        'email',
        'kelas',
        'tahun_masuk',
        'sekolah_asal',
    ]));

    return redirect()->route('operator.siswa.index')->with('success', 'Siswa berhasil ditambahkan.');
}

public function updateSiswa(Request $request, $id)
{
    $siswa = Siswa::findOrFail($id);

    $request->validate([
        'nama' => 'required|string|max:255',
        'nis' => 'required|string|unique:siswas,nis,' . $siswa->id,
        'jenis_kelamin' => 'required',
        'tanggal_lahir' => 'required|date',
        'tempat_lahir' => 'required|string|max:255',
        'agama' => 'required|string|max:50',
        'alamat' => 'required|string|max:500',
    ]);

    $siswa->update($request->only([
        'nama',
        'nis',
        'jenis_kelamin',
        'tanggal_lahir',
        'tempat_lahir',
        'agama',
        'alamat',
        'telepon',
        'email',
        'kelas',
        'tahun_masuk',
        'sekolah_asal',
    ]));

    return redirect()->route('operator.siswa.index')->with('success', 'Siswa berhasil diperbarui.');
}

public function editSiswa($id)
{
    $siswa = Siswa::findOrFail($id);
    return view('operator.edit-siswa', compact('siswa'));
}



public function destroySiswa($id)
{
    $siswa = Siswa::findOrFail($id);
    $siswa->delete();

    return redirect()->route('operator.siswa.index')->with('success', 'Siswa berhasil dihapus.');
}

}
