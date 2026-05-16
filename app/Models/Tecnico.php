<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tecnico extends Model
{
    public $timestamps=false;

    protected $fillable=[
    'id',
    'rut',
    'primero_nombre',
    'segundo_nombre',
    'apellido_paterno',
    'apellido_materno',
    'cargo_id'

    ];
}
