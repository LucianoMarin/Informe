<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Grado_institucional extends Model
{
     public $timestamps=false;

    protected $fillable=[
        'id',
        'nombre_grado',
        'institucion'
    ];
}
