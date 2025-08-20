<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\OperatorController;
use App\Http\Controllers\GuruController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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
    Route::get('/operator/kriteria', [OperatorController::class, 'indexKriteria'])->name('operator.kriteria.index');
    Route::get('/operator/kriteria/create', [OperatorController::class, 'createKriteria'])->name('operator.kriteria.create');
    Route::post('/operator/kriteria/store', [OperatorController::class, 'storeKriteria'])->name('operator.kriteria.store');
    Route::get('/operator/kriteria/{id}/edit', [OperatorController::class, 'editKriteria'])->name('operator.kriteria.edit');
    Route::put('/operator/kriteria/{id}', [OperatorController::class, 'updateKriteria'])->name('operator.kriteria.update');
    Route::delete('/operator/kriteria/{id}', [OperatorController::class, 'destroyKriteria'])->name('operator.kriteria.destroy');

    // ===== CRUD Data Siswa =====
  

// CRUD Siswa
Route::get('/operator/siswa', [OperatorController::class, 'indexSiswa'])->name('operator.siswa.index');
Route::get('/operator/siswa/create', [OperatorController::class, 'createSiswa'])->name('operator.siswa.create');
Route::post('/operator/siswa/store', [OperatorController::class, 'storeSiswa'])->name('operator.siswa.store');
Route::get('/operator/siswa/edit/{id}', [OperatorController::class, 'editSiswa'])->name('operator.siswa.edit');
Route::put('/operator/siswa/update/{id}', [OperatorController::class, 'updateSiswa'])->name('operator.siswa.update');
Route::delete('/operator/siswa/delete/{id}', [OperatorController::class, 'destroySiswa'])->name('operator.siswa.destroy');
Route::get('operator/siswa/{id}', [OperatorController::class, 'showSiswa'])->name('operator.siswa.show');


// CRUD Kelas
Route::get('/operator/kelas', [OperatorController::class, 'indexKelas'])->name('operator.kelas.index');
Route::get('/operator/kelas/create', [OperatorController::class, 'createKelas'])->name('operator.kelas.create');
Route::post('/operator/kelas/store', [OperatorController::class, 'storeKelas'])->name('operator.kelas.store');
Route::get('/operator/kelas/edit/{id}', [OperatorController::class, 'editKelas'])->name('operator.kelas.edit');
Route::put('/operator/kelas/update/{id}', [OperatorController::class, 'updateKelas'])->name('operator.kelas.update');
Route::delete('/operator/kelas/delete/{id}', [OperatorController::class, 'destroyKelas'])->name('operator.kelas.destroy');

// Seleksi AHP
Route::get('operator/kriteria/ahp', [OperatorController::class, 'ahpKriteria'])->name('operator.kriteria.ahp');
Route::post('operator/kriteria/ahp', [OperatorController::class, 'hitungAHP'])->name('operator.kriteria.hitung-ahp');


});


/*
|--------------------------------------------------------------------------
| Guru Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:guru'])->group(function () {
    Route::get('/guru/dashboard', [GuruController::class, 'dashboard'])->name('guru.dashboard');
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
