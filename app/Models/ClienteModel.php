<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClienteModel extends Model
{
    //
    protected $fillable = [
        'tipo_credito',
        'status',
        'registro',
    ];
}
