<?php

use App\Http\Controllers\ProfileController;
use App\Livewire\Student\Registration\DocumentComponent;
use App\Livewire\Student\Registration\StatusComponent;
use App\Livewire\Student\Registration\StepsComponent;
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

    Route::prefix('siswa')->group(function () {
        Route::get('/status', StatusComponent::class)->name('registration.status');
        Route::get('/dokumen', DocumentComponent::class)->name('registration.documents');
        
        // 2. Tempatkan route dengan wildcard di akhir (agar tidak menimpa yang lain)
    });

});

Route::prefix('pendaftaran')->group(function () {
    Route::get('/{slug}', StepsComponent::class)->name('registration.form');
});

// Route::get('/alur', fn() => view('option'))->name('alur');

require __DIR__.'/auth.php';
require __DIR__.'/admin.php';
