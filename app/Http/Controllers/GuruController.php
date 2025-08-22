<?php

namespace App\Http\Controllers;
use App\Models\HasilAHP;

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


}
