<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegistrationStepController;
use App\Livewire\DocumentUpload;
use App\Livewire\RegistrationSteps;
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
    Route::get('/status', [RegistrationStepController::class, 'status'])->name('registration.status');
    Route::get('/dokumen', DocumentUpload::class)->name('registration.documents');
    
    // 2. Tempatkan route dengan wildcard di akhir (agar tidak menimpa yang lain)
    Route::get('/{slug}', RegistrationSteps::class)->name('registration.form');
});
require __DIR__.'/auth.php';
require __DIR__.'/admin.php';
