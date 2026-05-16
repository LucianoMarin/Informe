<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dispositivo extends Model
{
    public $timestamps=false;

    protected $fillable=[
        'id',
        'tipo_dispositivos'

    ];
}
