<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Piso extends Model
{
      public $timestamps=false;

    protected $fillable=[
    'id',
    'nivel_piso',
    'orientacion',
    'edificio_id'

    ];
}
