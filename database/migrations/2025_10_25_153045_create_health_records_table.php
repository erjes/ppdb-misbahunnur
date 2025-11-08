<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('health_records', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained()->onDelete('cascade');
            $table->boolean('hepatitis')->default(false);
            $table->boolean('polio')->default(false);
            $table->boolean('bcg')->default(false);
            $table->boolean('campak')->default(false);
            $table->boolean('dpt')->default(false);
            $table->boolean('covid')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('health_records');
    }
};

