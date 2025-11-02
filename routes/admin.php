<?php

use App\Http\Controllers\StudentsController;
use App\Http\Controllers\AddressesController;
use App\Http\Controllers\ParentsController;
use App\Http\Controllers\DocumentsController;
use App\Http\Controllers\HealthRecordsController;
use App\Http\Controllers\GradesController;
use App\Http\Controllers\RegistrationsController;
use App\Http\Controllers\FeesController;
use App\Http\Controllers\PaymentsController;
use App\Http\Controllers\AudiosController;
use App\Http\Controllers\PendaftaranController;
use Illuminate\Support\Facades\Route;

// ... sisa kode routing Anda dimulai dari baris 16

// Admin routes dengan middleware auth dan admin
Route::middleware(['auth', 'super_admin'])->prefix('super-admin')->group(function () {
    
});


Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    
    // Students Management
    Route::prefix('students')->group(function () {
        Route::get('/', [StudentsController::class, 'index'])->name('admin.students.index');
        Route::get('/create', [StudentsController::class, 'create'])->name('admin.students.create');
        Route::post('/', [StudentsController::class, 'store'])->name('admin.students.store');
        Route::get('/{id}', [StudentsController::class, 'show'])->name('admin.students.show');
        Route::get('/{id}/edit', [StudentsController::class, 'edit'])->name('admin.students.edit');
        Route::put('/{id}', [StudentsController::class, 'update'])->name('admin.students.update');
        Route::delete('/{id}', [StudentsController::class, 'destroy'])->name('admin.students.destroy');
    });
    
    // Addresses Management
    Route::prefix('addresses')->group(function () {
        Route::get('/', [AddressesController::class, 'index'])->name('admin.addresses.index');
        Route::post('/', [AddressesController::class, 'store'])->name('admin.addresses.store');
        Route::get('/{id}', [AddressesController::class, 'show'])->name('admin.addresses.show');
        Route::put('/{id}', [AddressesController::class, 'update'])->name('admin.addresses.update');
        Route::delete('/{id}', [AddressesController::class, 'destroy'])->name('admin.addresses.destroy');
    });
    
    // Parents Management
    Route::prefix('parents')->group(function () {
        Route::get('/', [ParentsController::class, 'index'])->name('admin.parents.index');
        Route::post('/', [ParentsController::class, 'store'])->name('admin.parents.store');
        Route::get('/{id}', [ParentsController::class, 'show'])->name('admin.parents.show');
        Route::put('/{id}', [ParentsController::class, 'update'])->name('admin.parents.update');
        Route::delete('/{id}', [ParentsController::class, 'destroy'])->name('admin.parents.destroy');
    });
    
    // Documents Management
    Route::prefix('documents')->group(function () {
        Route::get('/', [DocumentsController::class, 'index'])->name('admin.documents.index');
        Route::post('/', [DocumentsController::class, 'store'])->name('admin.documents.store');
        Route::get('/{id}', [DocumentsController::class, 'show'])->name('admin.documents.show');
        Route::put('/{id}', [DocumentsController::class, 'update'])->name('admin.documents.update');
        Route::delete('/{id}', [DocumentsController::class, 'destroy'])->name('admin.documents.destroy');
    });
    
    // Health Records Management
    Route::prefix('health-records')->group(function () {
        Route::get('/', [HealthRecordsController::class, 'index'])->name('admin.health-records.index');
        Route::post('/', [HealthRecordsController::class, 'store'])->name('admin.health-records.store');
        Route::get('/{id}', [HealthRecordsController::class, 'show'])->name('admin.health-records.show');
        Route::put('/{id}', [HealthRecordsController::class, 'update'])->name('admin.health-records.update');
        Route::delete('/{id}', [HealthRecordsController::class, 'destroy'])->name('admin.health-records.destroy');
    });
    
    // Grades Management
    Route::prefix('grades')->group(function () {
        Route::get('/', [GradesController::class, 'index'])->name('admin.grades.index');
        Route::post('/', [GradesController::class, 'store'])->name('admin.grades.store');
        Route::get('/{id}', [GradesController::class, 'show'])->name('admin.grades.show');
        Route::put('/{id}', [GradesController::class, 'update'])->name('admin.grades.update');
        Route::delete('/{id}', [GradesController::class, 'destroy'])->name('admin.grades.destroy');
    });
    
    // Registrations Management
    Route::prefix('registrations')->group(function () {
        Route::get('/', [RegistrationsController::class, 'index'])->name('admin.registrations.index');
        Route::post('/', [RegistrationsController::class, 'store'])->name('admin.registrations.store');
        Route::get('/{id}', [RegistrationsController::class, 'show'])->name('admin.registrations.show');
        Route::put('/{id}', [RegistrationsController::class, 'update'])->name('admin.registrations.update');
        Route::delete('/{id}', [RegistrationsController::class, 'destroy'])->name('admin.registrations.destroy');
    });
    
    // Fees Management
    Route::prefix('fees')->group(function () {
        Route::get('/', [FeesController::class, 'index'])->name('admin.fees.index');
        Route::post('/', [FeesController::class, 'store'])->name('admin.fees.store');
        Route::get('/{id}', [FeesController::class, 'show'])->name('admin.fees.show');
        Route::put('/{id}', [FeesController::class, 'update'])->name('admin.fees.update');
        Route::delete('/{id}', [FeesController::class, 'destroy'])->name('admin.fees.destroy');
    });
    
    // Payments Management
    Route::prefix('payments')->group(function () {
        Route::get('/', [PaymentsController::class, 'index'])->name('admin.payments.index');
        Route::post('/', [PaymentsController::class, 'store'])->name('admin.payments.store');
        Route::get('/{id}', [PaymentsController::class, 'show'])->name('admin.payments.show');
        Route::put('/{id}', [PaymentsController::class, 'update'])->name('admin.payments.update');
        Route::delete('/{id}', [PaymentsController::class, 'destroy'])->name('admin.payments.destroy');
    });
    
    // Audios Management
    Route::prefix('audios')->group(function () {
        Route::get('/', [AudiosController::class, 'index'])->name('admin.audios.index');
        Route::post('/', [AudiosController::class, 'store'])->name('admin.audios.store');
        Route::get('/{id}', [AudiosController::class, 'show'])->name('admin.audios.show');
        Route::put('/{id}', [AudiosController::class, 'update'])->name('admin.audios.update');
        Route::delete('/{id}', [AudiosController::class, 'destroy'])->name('admin.audios.destroy');
    });
    
    // Pendaftaran Management
    Route::prefix('pendaftaran')->group(function () {
        Route::get('/', [RegistrationsController::class, 'index'])->name('admin.pendaftaran.index');
        Route::post('/', [RegistrationsController::class, 'store'])->name('admin.pendaftaran.store');
        Route::get('/{id}', [RegistrationsController::class, 'show'])->name('admin.pendaftaran.show');
        Route::put('/{id}', [RegistrationsController::class, 'update'])->name('admin.pendaftaran.update');
        Route::delete('/{id}', [RegistrationsController::class, 'destroy'])->name('admin.pendaftaran.destroy');
    });
});


