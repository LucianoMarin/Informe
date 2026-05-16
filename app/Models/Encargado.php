<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Encargado extends Model
{
     public $timestamps=false;

    protected $fillable=[
    'id',
    'rut',
    'primer_nombre',
    'segundo_nombre',
    'apellido_paterno',
    'apellido_materno',
    'contrato_id',
    'departamento_id'

    ];
}
