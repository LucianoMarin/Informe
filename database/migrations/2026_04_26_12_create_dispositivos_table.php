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
        Schema::create('dispositivos', function (Blueprint $table) {
            $table->id();
            $table->String('serie')->unique();
            $table->integer('cgu')->unique();
            $table->String('nombre_dispositivo');
            $table->foreignId('tipo_dispositivo_id')->constrained('tipo_dispositivos')->cascadeOnDelete();

            $table->enum('estado',['dañado','reparado','reacondicionado','obsoleto']);
            
            
            $table->foreignId('ubicacion_id')->constrained('ubicacions')->cascadeOnDelete();
            
            $table->date('fecha_ingreso')->nullable();


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dispositivos');
    }
};
