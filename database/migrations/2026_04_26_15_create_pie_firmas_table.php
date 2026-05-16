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
        Schema::create('pie_firmas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('jefatura_id')->constrained('jefaturas')->cascadeOnDelete();
            $table->foreignId('encargado_id')->constrained('encargados')->cascadeOnDelete();
            $table->date('fecha_creacion');
            $table->boolean('activo')->default(false);
        
            $table->unique(['jefatura_id','encargado_id']);
            

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pie_firmas');
    }
};
