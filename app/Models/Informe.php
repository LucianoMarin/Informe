<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Informe extends Model
{
    public $timestamps=false;

    protected $fillable=[

    'id',
    'usuario_id',
    'tipo_documento',
    'codigo_informe',
    'fecha_informe',
    'titulo',
    'descripcion_informe',
    'dispositivo_id',
    'ubicacion_id',
    'pie_informe',
    'pie_firmas_id',
    'tecnico_id',
    'estado_informe'


    ];
}
