<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jefatura extends Model
{
      public $timestamps=false;

    protected $fillable=[
    'id',
    'primer_nombre',
    'segundo_nombre',
    'apellido_paterno',
    'apellido_materno',
    'departamento_id',
    'grado_institucional_id'

    ];
}
