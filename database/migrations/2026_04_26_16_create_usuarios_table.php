<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  
    public function up(): void
    {
        Schema::create('usuarios', function (Blueprint $table) {
           
            $table->id();
            $table->String('usuario')->unique();
            $table->integer('clave');
            $table->integer('intento')->default(0);
            $table->integer('permiso')->default(0);

                    
           $table->foreignId('tecnico_id')->constrained('tecnicos')
           ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usuarios');
    }
};
