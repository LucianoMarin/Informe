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
        Schema::create('grado_institucionals', function (Blueprint $table) {
            $table->id();
            $table->String('nombre_grado');
            $table->String('institucion');
            
            $table->unique(['nombre_grado','institucion']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('grado_institucionals');
    }
};
