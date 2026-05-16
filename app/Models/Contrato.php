<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contrato extends Model
{
    public $timestamps=false;

    protected $fillable=[
        'id',
        'nombre_contrato',
        'grado'

    ];
}
