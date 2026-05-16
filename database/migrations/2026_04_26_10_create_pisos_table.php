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
        Schema::create('pisos', function (Blueprint $table) {
            $table->id();
            $table->enum('nivel_piso',['z','-2','-1','1','2','3','4','5','6','7','8','9','10','11','12']);
            $table->enum('orientacion',['norte','sur','oriente','poniente','nororiente','norporiente','suroriente','surponiente']);
  
            $table->foreignId('edificio_id')->constrained('edificios')
           ->cascadeOnDelete();

           
            $table->unique(['edificio_id', 'nivel_piso']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pisos');
    }
};
