<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pie_firma extends Model
{
      public $timestamps=false;

    protected $fillable=[
    'id',
    'jefatura_id',
    'encargado_id',
    'fecha_creacion',
    'activo',
    

    ];
}
