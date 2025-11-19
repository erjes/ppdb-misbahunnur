<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('letter_settings', function (Blueprint $table) {
            $table->id();
            $table->string('sk_number')->nullable();
            $table->string('date_string')->nullable(); 
            $table->string('school_year')->nullable();
            $table->string('signer_name')->nullable();
            $table->string('signer_title')->nullable();
            $table->text('menimbang')->nullable();     
            $table->text('memperhatikan')->nullable(); 
            $table->string('payment_start')->nullable();
            $table->string('payment_end_1')->nullable();
            $table->string('payment_end_2')->nullable();
            $table->text('bank_info')->nullable();
            $table->string('signature_path')->nullable();
            $table->string('stamp_path')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('letter_settings');
    }
};
