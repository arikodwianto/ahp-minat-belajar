<?php

namespace App\Http\Controllers;
use App\Models\HasilAHP;
use App\Models\Kelas;
use App\Models\Siswa;

class GuruController extends Controller
{
    public function dashboard()
    {
        return view('guru.dashboard');
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


}
