<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('students', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('nomor_pendaftaran')->unique()->comment('Nomor unik pendaftaran.');
            $table->string('nama_lengkap');
            $table->string('nisn', 10)->unique()->nullable();
            $table->string('nik_siswa', 16)->unique();

            $table->enum('jenis_kelamin', ['L', 'P']);
            $table->string('tempat_kelahiran');
            $table->date('tanggal_lahir');
            $table->string('agama');
            $table->string('no_hp', 15)->nullable();
            
            $table->string('nama_ayah')->nullable();
            $table->string('nama_ibu')->nullable();
            $table->string('no_kk', 16)->nullable();

            $table->timestamps();

        });
    }

    public function down(): void {
        Schema::dropIfExists('students');
    }
};

