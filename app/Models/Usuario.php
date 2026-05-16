<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{

    public $timestamps=false;

    protected $fillable=[
        'id',
        'usuario',
        'clave',
        'intento',
        'permiso',
        'tecnico_id'

    ];
}
