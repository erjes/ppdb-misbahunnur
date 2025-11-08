<?php

use App\Exports\StudentsExport;
use App\Livewire\Admin\Registration\RequiredDocumentsComponent;
use App\Livewire\Admin\Registration\DetailsComponent;
use App\Livewire\Admin\Registration\RegistrantComponent;
use App\Livewire\Admin\Students\MAComponent;
use App\Livewire\Admin\Students\MTSComponent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Maatwebsite\Excel\Facades\Excel;

Route::middleware(['auth', 'verified', 'super_admin'])->prefix('super-admin')->group(function () {
    
});

Route::middleware(['auth', 'verified', 'admin'])->group(function () {
    
    Route::prefix('admin')->group(function () {

    Route::prefix('pendaftaran')->group(function () {
        Route::get('/', RegistrantComponent::class)->name('admin.registrations.list');
        Route::get('/status/{nomor_pendaftaran}', DetailsComponent::class)->name('admin.registrations.status');
        Route::get('/dokumen/{nomor_pendaftaran}', RequiredDocumentsComponent::class)->name('admin.registrations.documents');
    });

    Route::prefix('siswa')->group(function () {
        Route::get('/MTS', MTSComponent::class)->name('admin.students.mts');
        Route::get('/MA', MAComponent::class)->name('admin.students.ma');

        Route::get('/students/export/{jenjang}', function (Request $request, string $jenjang) {
            $filename = 'students_' . strtolower($jenjang) . '_' . now()->format('Ymd_His') . '.xlsx';
            return Excel::download(
                new StudentsExport(
                    jenjang: $jenjang,
                    search: $request->query('q'),
                    sort: $request->query('sort', 'students.created_at'),
                    dir: $request->query('dir', 'desc'),
                ),
                $filename
            );
        })->name('admin.students.export');
    });

    
    Route::prefix('pembayaran')->group(function () {

    });


});

});

Route::middleware(['auth', 'admin'])->get('/documents/{studentId}/{filename}', function ($studentId, $filename) {
    
    $filePath = storage_path("app/private/documents/{$studentId}/{$filename}");
    if (file_exists($filePath)) {
        return response()->file($filePath);
    }
    abort(404);
    
})->name('documents.show');

