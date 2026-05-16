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
        Schema::create('informes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('usuario_id')->constrained('usuarios')->cascadeOnDelete();

            $table->enum('tipo_documento', ['Informe baja', 'Acta']);
            $table->String('codigo_informe')->unique();
            $table->date('fecha_informe');
            $table->String('titulo');
            $table->String('descripcion_informe');

               
            $table->foreignId('dispositivo_id')->constrained('dispositivos')->cascadeOnDelete();
            $table->foreignId('ubicacion_id')->constrained('ubicacions')->cascadeOnDelete();
            
            
            $table->String('pie_informe');
            
           
            $table->foreignId('pie_firmas_id')->constrained('pie_firmas')->cascadeOnDelete();
            $table->foreignId('tecnico_id')->constrained('tecnicos')->cascadeOnDelete();

            $table->enum('estado_informe',['generado','realizado','pendiente']);

            });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('informes');
    }
};
