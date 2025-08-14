<?php
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\OperatorController;
use App\Http\Controllers\GuruController;
use Illuminate\Support\Facades\Route;

use Illuminate\Support\Facades\Auth;



Route::get('/dashboard', function () {
    if (Auth::check()) {
        // arahkan sesuai role
        if (Auth::user()->role === 'operator') {
            return redirect()->route('operator.dashboard');
        } elseif (Auth::user()->role === 'guru') {
            return redirect()->route('guru.dashboard');
        }
    }
    return redirect('/login'); // fallback jika belum login
})->middleware('auth')->name('dashboard');




// Redirect setelah login sesuai role
Route::get('/redirect-after-login', function () {
    if (auth()->user()->role === 'operator') {
        return redirect()->route('operator.dashboard');
    } elseif (auth()->user()->role === 'guru') {
        return redirect()->route('guru.dashboard');
    }
    abort(403);
})->middleware('auth')->name('redirect.after.login');

// Dashboard Operator
Route::middleware(['auth', 'role:operator'])->group(function () {
    Route::get('/operator/dashboard', [OperatorController::class, 'dashboard'])->name('operator.dashboard');
});

// Dashboard Guru
Route::middleware(['auth', 'role:guru'])->group(function () {
    Route::get('/guru/dashboard', [GuruController::class, 'dashboard'])->name('guru.dashboard');
});

// Route profile
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::middleware(['auth', 'role:operator'])->group(function () {
    Route::get('/operator/dashboard', [OperatorController::class, 'dashboard'])->name('operator.dashboard');
    Route::get('/operator/guru/create', [OperatorController::class, 'createGuru'])->name('operator.guru.create');
    Route::post('/operator/guru/store', [OperatorController::class, 'storeGuru'])->name('operator.guru.store');
});


require __DIR__.'/auth.php';

