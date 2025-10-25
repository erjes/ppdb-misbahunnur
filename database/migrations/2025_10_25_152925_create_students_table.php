<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('no_daftar')->nullable();
            $table->string('nisn')->nullable();
            $table->string('nik')->nullable();
            $table->string('nama');
            $table->string('jenis_kelamin', 1)->nullable();
            $table->string('tempat_lahir')->nullable();
            $table->date('tgl_lahir')->nullable();
            $table->string('agama')->nullable();
            $table->string('asal_sekolah')->nullable();
            $table->string('npsn_asal')->nullable();
            $table->string('jenjang')->nullable();
            $table->string('jurusan')->nullable();
            $table->string('foto')->nullable();
            $table->string('no_kk')->nullable();
            $table->string('nis')->nullable();
            $table->integer('anak_ke')->nullable();
            $table->integer('saudara')->nullable();
            $table->string('status_keluarga')->nullable();
            $table->boolean('paud')->default(false);
            $table->boolean('tk')->default(false);
            $table->string('citacita')->nullable();
            $table->string('hobi')->nullable();
            $table->string('sekolah_tujuan')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('students');
    }
};

