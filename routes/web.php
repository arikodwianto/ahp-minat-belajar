<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\OperatorController;
use App\Http\Controllers\GuruController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\PerbandinganKriteriaController;
use App\Http\Controllers\KriteriaController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Root langsung ke login
Route::get('/', function () {
    return redirect('/login');
});

// Route dashboard untuk redirect setelah login sesuai role
Route::get('/dashboard', function () {
    if (auth()->user()->role === 'operator') {
        return redirect()->route('operator.dashboard');
    } elseif (auth()->user()->role === 'guru') {
        return redirect()->route('guru.dashboard');
    }
    abort(403); // jika role tidak dikenali
})->middleware('auth')->name('dashboard');

/*
|--------------------------------------------------------------------------
| IMport Excel Siswa
|--------------------------------------------------------------------------
*/
Route::get('/operator/siswa/template', function () {
    return response()->download(public_path('templates/template_siswa.xlsx'));
})->name('operator.siswa.template');


/*
|--------------------------------------------------------------------------
| Operator Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:operator'])->group(function () {

    // Dashboard Operator
    Route::get('/operator/dashboard', [OperatorController::class, 'dashboard'])->name('operator.dashboard');

    // ===== CRUD Guru =====
    Route::get('/operator/guru', [OperatorController::class, 'indexGuru'])->name('operator.guru.index');
    Route::get('/operator/guru/create', [OperatorController::class, 'createGuru'])->name('operator.guru.create');
    Route::post('/operator/guru/store', [OperatorController::class, 'storeGuru'])->name('operator.guru.store');
    Route::get('/operator/guru/{id}/edit', [OperatorController::class, 'editGuru'])->name('operator.guru.edit');
    Route::put('/operator/guru/{id}', [OperatorController::class, 'updateGuru'])->name('operator.guru.update');
    Route::delete('/operator/guru/{id}', [OperatorController::class, 'destroyGuru'])->name('operator.guru.destroy');

   // ===== CRUD Kriteria =====
Route::prefix('operator/kriteria')->name('operator.kriteria.')->group(function () {
    Route::get('/', [OperatorController::class, 'indexKriteria'])->name('index');
    Route::get('/create', [OperatorController::class, 'createKriteria'])->name('create');
    Route::post('/store', [OperatorController::class, 'storeKriteria'])->name('store');
    Route::get('/{id}/edit', [OperatorController::class, 'editKriteria'])->name('edit');
    Route::put('/{id}', [OperatorController::class, 'updateKriteria'])->name('update');
    Route::delete('/{id}', [OperatorController::class, 'destroyKriteria'])->name('destroy');

    // === Seleksi AHP ===
    Route::get('/ahp', [OperatorController::class, 'kriteriaPerbandingan'])->name('ahp'); 
    Route::post('/ahp/hitung', [OperatorController::class, 'hitungAHP'])->name('hitungAHP'); 
    Route::get('/hasil', [OperatorController::class, 'hasilAHP'])->name('hasilAHP'); 

    // === Perbandingan Kriteria ===
    Route::prefix('perbandingan')->name('perbandingan.')->group(function () {
        Route::get('/', [OperatorController::class, 'kriteriaPerbandingan'])->name('index'); 
        Route::post('/simpan', [OperatorController::class, 'simpanPerbandingan'])->name('simpan');
        Route::post('/hitung', [OperatorController::class, 'hitungAHP'])->name('hitung');
    });
});

    // ===== CRUD Data Siswa =====
  

// CRUD Siswa
Route::get('/operator/siswa', [OperatorController::class, 'indexSiswa'])->name('operator.siswa.index');
Route::get('/operator/siswa/create', [OperatorController::class, 'createSiswa'])->name('operator.siswa.create');
Route::post('/operator/siswa/store', [OperatorController::class, 'storeSiswa'])->name('operator.siswa.store');
Route::get('/operator/siswa/edit/{id}', [OperatorController::class, 'editSiswa'])->name('operator.siswa.edit');
Route::put('/operator/siswa/update/{id}', [OperatorController::class, 'updateSiswa'])->name('operator.siswa.update');
Route::delete('/operator/siswa/delete/{id}', [OperatorController::class, 'destroySiswa'])->name('operator.siswa.destroy');
Route::get('operator/siswa/{id}', [OperatorController::class, 'showSiswa'])->name('operator.siswa.show');
Route::post('/operator/siswa/import', [OperatorController::class, 'importSiswa'])->name('operator.siswa.import');


// CRUD Kelas
Route::get('/operator/kelas', [OperatorController::class, 'indexKelas'])->name('operator.kelas.index');
Route::get('/operator/kelas/create', [OperatorController::class, 'createKelas'])->name('operator.kelas.create');
Route::post('/operator/kelas/store', [OperatorController::class, 'storeKelas'])->name('operator.kelas.store');
Route::get('/operator/kelas/edit/{id}', [OperatorController::class, 'editKelas'])->name('operator.kelas.edit');
Route::put('/operator/kelas/update/{id}', [OperatorController::class, 'updateKelas'])->name('operator.kelas.update');
Route::delete('/operator/kelas/delete/{id}', [OperatorController::class, 'destroyKelas'])->name('operator.kelas.destroy');



    
   

    // Pertanyaan
    Route::prefix('pertanyaan')->name('pertanyaan.')->group(function () {
        Route::get('/', [OperatorController::class, 'indexPertanyaan'])->name('index');
        Route::get('/create', [OperatorController::class, 'createPertanyaan'])->name('create');
        Route::post('/', [OperatorController::class, 'storePertanyaan'])->name('store');
        Route::get('/{id}/edit', [OperatorController::class, 'editPertanyaan'])->name('edit');
        Route::put('/{id}', [OperatorController::class, 'updatePertanyaan'])->name('update');
        Route::delete('/{id}', [OperatorController::class, 'destroyPertanyaan'])->name('destroy');
    });

    // Jawaban
    Route::prefix('jawaban')->name('jawaban.')->group(function () {
        Route::get('/', [OperatorController::class, 'indexJawaban'])->name('index');
        Route::get('/create', [OperatorController::class, 'createJawaban'])->name('create');
        Route::post('/', [OperatorController::class, 'storeJawaban'])->name('store');
        Route::get('/{id}/edit', [OperatorController::class, 'editJawaban'])->name('edit');
        Route::put('/{id}', [OperatorController::class, 'updateJawaban'])->name('update');
        Route::delete('/{id}', [OperatorController::class, 'destroyJawaban'])->name('destroy');
    });

    // Form Kuisioner siswa
    Route::get('/siswa/{siswaId}/kuisioner', [OperatorController::class, 'isiForm'])->name('kuisioner.isi');
    Route::post('/siswa/{siswaId}/kuisioner', [OperatorController::class, 'simpanForm'])->name('kuisioner.simpan');

    // Hasil Kuisioner
    Route::get('/kuisioner', [OperatorController::class, 'index'])->name('kuisioner.index');
    Route::post('/kuisioner', [OperatorController::class, 'store'])->name('kuisioner.store');
    Route::get('/kuisioner/hasil', [OperatorController::class, 'hasil'])->name('kuisioner.hasil');
});
 Route::prefix('alternatif')->name('alternatif.')->group(function () {
        Route::get('/', [OperatorController::class, 'indexAlternatif'])->name('index');
        Route::get('/create', [OperatorController::class, 'createAlternatif'])->name('create');
        Route::post('/', [OperatorController::class, 'storeAlternatif'])->name('store');
        Route::get('/{id}/edit', [OperatorController::class, 'editAlternatif'])->name('edit');
        Route::put('/{id}', [OperatorController::class, 'updateAlternatif'])->name('update');
        Route::delete('/{id}', [OperatorController::class, 'destroyAlternatif'])->name('destroy');
    });
Route::prefix('operator/perbandingan-alternatif')->name('perbandingan_alternatif.')->group(function () {
    // daftar siswa
    Route::get('/', [OperatorController::class, 'indexPerbandinganAlternatif'])->name('index');

    // form input perbandingan alternatif per siswa
    Route::get('/{siswa}/create', [OperatorController::class, 'createPerbandinganAlternatif'])->name('create');
    Route::post('/{siswa}', [OperatorController::class, 'storePerbandinganAlternatif'])->name('store');

    // lihat hasil perbandingan siswa
    Route::get('/{siswa}/show', [OperatorController::class, 'showPerbandinganAlternatif'])->name('show');

    Route::get('/hasil-siswa', [OperatorController::class, 'indexHasilSiswa'])->name('hasil-siswa');

    // cetak laporan
    Route::get('/{siswa}/cetak', [OperatorController::class, 'cetakPerbandingan'])->name('cetak');

  Route::get('/cetak-pdf', [OperatorController::class, 'cetakPdfHasilSiswa'])->name('cetak_pdf');

});








/*
|--------------------------------------------------------------------------
| Guru Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:guru'])->group(function () {
    Route::get('/guru/dashboard', [GuruController::class, 'dashboard'])->name('guru.dashboard');
    Route::get('/guru/hasil-ahp', [GuruController::class, 'hasilAHP'])->name('guru.hasil.ahp');
    Route::get('/guru/siswa', [GuruController::class, 'indexSiswa'])->name('guru.index.siswa');

});

/*
|--------------------------------------------------------------------------
| Profile Routes
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Auth routes (login, register, password reset, etc.)
require __DIR__.'/auth.php';
