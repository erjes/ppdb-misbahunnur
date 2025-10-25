<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('fee_id')->nullable()->constrained('fees')->onDelete('set null');
            $table->string('kode_pembayaran')->unique();
            $table->integer('jumlah');
            $table->date('tanggal_bayar');
            $table->string('bukti')->nullable();
            $table->boolean('verifikasi')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('payments');
    }
};
