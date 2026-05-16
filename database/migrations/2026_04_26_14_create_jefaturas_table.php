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
        Schema::create('jefaturas', function (Blueprint $table) {
            $table->id();
            $table->String('primer_nombre');
            $table->String('segundo_nombre')->nullable();
            $table->String('apellido_paterno');
            $table->String('apellido_materno');
            $table->foreignId('departamento_id')->constrained('departamentos')->cascadeOnDelete();
            $table->foreignId('grado_institucional_id')->constrained('grado_institucionals')->cascadeOnDelete();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jefaturas');
    }
};
