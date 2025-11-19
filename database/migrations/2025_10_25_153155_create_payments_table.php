<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained()->onDelete('cascade');
            $table->foreignId('fee_id')->nullable()->constrained('fees')->onDelete('set null');
            $table->string('bukti_pembayaran')->nullable();
            $table->integer('jumlah')->nullable();
            $table->date('tanggal_bayar')->nullable();
            $table->boolean('verifikasi')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('payments');
    }
};
