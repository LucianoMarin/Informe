<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tipo_dispositivo extends Model
{
     public $timestamps=false;

    protected $fillable=[
        'id',
        'tipo_disposito',
        

    ];
}
