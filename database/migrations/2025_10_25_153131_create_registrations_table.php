<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('registrations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained()->onDelete('cascade');
            $table->date('tgl_daftar')->nullable();
            $table->date('tgl_konfirmasi')->nullable();
            $table->boolean('is_confirmed')->default(false);
            $table->boolean('is_active')->default(true);
            $table->string('status')->nullable(); // diterima, pending, ditolak
            $table->string('level')->nullable();
            $table->date('tgl_keluar')->nullable();
            $table->string('alasan_keluar')->nullable();
            $table->boolean('online')->default(true);
            $table->boolean('is_paid')->default(false);

            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('registrations');
    }
};
