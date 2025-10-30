<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegistrationsController;
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


Route::get('/alur', fn() => view('option'))->name('alur');

Route::prefix('siswa')->group(function () {
    Route::get('/daftar', fn() => view('siswa.daftar'))->name('daftar');
    Route::post('/daftar', [RegistrationsController::class, 'store'])->name('daftar.store');

    Route::get('/login', fn() => view('siswa.login'))->name('login.siswa');
});
require __DIR__.'/auth.php';
require __DIR__.'/admin.php';
