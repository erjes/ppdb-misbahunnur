<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
public function up()
{
    Schema::table('letter_settings', function (Blueprint $table) {
        // Paragraf Pembuka
        $table->text('p2_opening')->nullable();      
        $table->text('p2_conditional')->nullable();          
        $table->text('p2_requirements')->nullable();
        $table->text('p2_payment_terms')->nullable(); 
        
        // Bagian Pengunduran Diri
        $table->text('p2_resign_intro')->nullable(); 
        $table->text('p2_resign_points')->nullable();
        
        // Penutup & Footer
        $table->text('p2_closing')->nullable();      
        $table->text('p2_footer_note')->nullable();  
    });
}

public function down()
{
    Schema::table('letter_settings', function (Blueprint $table) {
        $table->dropColumn([
            'p2_opening', 'p2_conditional', 'p2_requirements', 
            'p2_payment_terms', 'p2_resign_intro', 'p2_resign_points', 
            'p2_closing', 'p2_footer_note'
        ]);
    });
}
};