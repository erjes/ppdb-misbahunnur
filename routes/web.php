<?php

use App\Http\Controllers\ProfileController;
use App\Livewire\Admin\Content\HomeComponent;
use App\Livewire\Admin\Content\VideoComponent;
use App\Livewire\Student\Payment\PaymentComponent;
use App\Livewire\Student\Registration\DocumentComponent;
use App\Livewire\Student\Registration\StatusComponent;
use App\Livewire\Student\Registration\StepsComponent;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/',HomeComponent::class)->name('home');

Route::get('/dashboard', function () {
    
    if (Auth::user()->role === 'admin_mts' || Auth::user()->role === 'admin_ma') {
        return redirect()->route('admin.registrations.registrant');
    }

    if (Auth::user()->role === 'user') {
        return redirect()->route('registration.status');
    }

})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth'])->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::prefix('siswa')->group(function () {
        Route::get('/pembayaran/{studentId}/upload', PaymentComponent::class)->name('registration.payment.upload');
        Route::get('/status', StatusComponent::class)->name('registration.status');
        Route::get('/dokumen', DocumentComponent::class)->name('registration.documents');
        
        // 2. Tempatkan route dengan wildcard di akhir (agar tidak menimpa yang lain)
    });

});

Route::prefix('pendaftaran')->group(function () {

    Route::get('/{slug}', StepsComponent::class)->name('registration.form');

});

Route::get('/video/{filename}', function ($filename) {
    $filePath = storage_path("app/private/videos/{$filename}");

    if (file_exists($filePath)) {
        return response()->file($filePath);
    }

    abort(404);
})->name('admin.videos.show');


require __DIR__.'/auth.php';
require __DIR__.'/admin.php';
