<?php

use App\Http\Controllers\PendaftaranBeasiswaController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/jenis-beasiswa');

Route::get('/jenis-beasiswa', [PendaftaranBeasiswaController::class, 'jenisBeasiswa'])
    ->name('jenis.beasiswa');

Route::get('/pendaftaran', [PendaftaranBeasiswaController::class, 'create'])
    ->name('pendaftaran.create');
Route::post('/pendaftaran', [PendaftaranBeasiswaController::class, 'store'])
    ->name('pendaftaran.store');

Route::get('/hasil', [PendaftaranBeasiswaController::class, 'hasil'])
    ->name('hasil.pendaftaran');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
