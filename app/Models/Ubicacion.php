<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ubicacion extends Model
{
    public $timestamps=false;

    protected $fillable=[
        'id',
        'edificio_id',
        'piso_id'

    ];
}
