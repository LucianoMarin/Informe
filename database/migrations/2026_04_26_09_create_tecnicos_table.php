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
        Schema::create('tecnicos', function (Blueprint $table) {
            $table->id();
            $table->String('rut');
            $table->String('primero_nombre');
            $table->String('segundo_nombre');
            $table->String('apellido_paterno');
            $table->String('apellido_materno');
            
            $table->foreignId('cargo_id')->constrained('cargos')
            ->cascadeOnDelete();
    
           
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tecnicos');
    }
};
