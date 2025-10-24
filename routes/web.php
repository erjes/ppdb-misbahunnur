<?php

use App\Http\Controllers\PendaftaranController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'verified','admin'])->group(function () {
    route::get('/admin', [App\Http\Controllers\AdminController::class, 'index'])->name('admin.index');
});

Route::get('/alur', fn() => view('option'))->name('alur');
Route::get('/daftar', fn() => view('siswa.daftar'))->name('daftar');
Route::delete('/daftar', [PendaftaranController::class, 'store'])->name('daftar.store');
Route::get('/login/siswa', fn() => view('siswa.login'))->name('login.siswa');

require __DIR__.'/auth.php';
