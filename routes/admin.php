<?php

use App\Exports\StudentsExport;
use App\Livewire\Admin\Content\PosterComponent;
use App\Livewire\Admin\Content\VideoComponent;
use App\Livewire\Admin\Payment\FeesComponent;
use App\Livewire\Admin\Payment\PaymentListComponent;
use App\Livewire\Admin\Payment\PaymentVerificationComponent;
use App\Livewire\Admin\Registration\AdmissionSettingsComponent;
use App\Livewire\Admin\Registration\RequiredDocumentsComponent;
use App\Livewire\Admin\Registration\DetailsComponent;
use App\Livewire\Admin\Registration\RegistrantComponent;
use App\Livewire\Admin\Students\DataComponent;
use App\Livewire\Admin\Students\ExportComponent;
use App\Livewire\Admin\Pdf\LetterComponent;
use App\Livewire\Admin\Students\MAComponent;
use App\Livewire\Admin\Students\MTSComponent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Maatwebsite\Excel\Facades\Excel;

Route::middleware(['auth'])
    ->prefix('admin')
    ->group(function () {
        Route::middleware(['admin'])->prefix('pendaftaran')->group(function () {
            Route::get('/', RegistrantComponent::class)
                ->name('admin.registrations.registrant');

            Route::get('/status/{studentId}', DetailsComponent::class)
                ->name('admin.registrations.status');

            Route::get('/dokumen/{studentId}', RequiredDocumentsComponent::class)
                ->name('admin.registrations.documents');

            Route::get('/pengaturan', AdmissionSettingsComponent::class)
                ->name('admin.registrations.settings');

            Route::get('/edit-surat', LetterComponent::class)
                ->name('admin.registrations.letter');
        });

        Route::middleware(['admin'])->prefix('pembayaran')->group(function () {
            Route::get('/', PaymentListComponent::class)
                ->name('admin.payments.list');

            Route::get('/{studentId}/verifikasi', PaymentVerificationComponent::class)
                ->name('admin.payments.verify');

            Route::get('biaya', FeesComponent::class)
                ->name('admin.payments.fees');
        });

        Route::middleware(['admin'])->prefix('siswa')->group(function () {
            Route::get('/data', DataComponent::class)
            ->name('admin.students.data');

            Route::get('/ekspor-data', ExportComponent::class)
            ->name('admin.students.export');

        });

        Route::middleware(['admin'])->prefix('konten')->group(function () {
            Route::get('/video', VideoComponent::class)
                ->name('admin.content.video');

            Route::get('/poster', PosterComponent::class)
                ->name('admin.content.poster');
        });
        
        Route::middleware(['admin'])->get('/documents/{studentId}/{filename}', function ($studentId, $filename) {
            $filePath = storage_path("app/private/documents/{$studentId}/{$filename}");

            if (file_exists($filePath)) {
                return response()->file($filePath);
            }

            abort(404);
        })->name('admin.documents.show');

        Route::middleware(['admin'])->get('/payments/{studentId}/{filename}', function ($studentId, $filename) {
            $filePath = storage_path("app/private/payments/{$studentId}/{$filename}");

            if (file_exists($filePath)) {
                return response()->file($filePath);
            }

            abort(404);
        })->name('admin.payments.show');
    });
