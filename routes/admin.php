<?php

use App\Livewire\Admin\Registration\ListDocumentComponent;
use App\Livewire\Admin\Registration\DetailsComponent;
use App\Livewire\Admin\Registration\ListComponent;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'verified', 'super_admin'])->prefix('super-admin')->group(function () {
    
});

Route::middleware(['auth', 'verified', 'admin'])->group(function () {
    
    Route::prefix('admin')->group(function () {
    Route::get('/pendaftaran', ListComponent::class)->name('admin.registrations.list');
    Route::get('/pendaftaran/status/{nomor_pendaftaran}', DetailsComponent::class)->name('admin.registrations.status');
    Route::get('/pendaftaran/dokumen/{nomor_pendaftaran}', ListDocumentComponent::class)->name('admin.registrations.documents');
    
});

});

Route::middleware(['auth', 'admin'])->get('/documents/{studentId}/{filename}', function ($studentId, $filename) {
    
    $filePath = storage_path("app/private/documents/{$studentId}/{$filename}");
    if (file_exists($filePath)) {
        return response()->file($filePath);
    }
    abort(404);
    
})->name('documents.show');

