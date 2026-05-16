<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Edificio extends Model
{
    public $timestamps=false;

    protected $fillable=[
        'id',
        'nombre_edificio',
        'direccion'

    ];
}
