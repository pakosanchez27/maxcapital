<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClienteModel extends Model
{

    protected $table = 'clientes'; // o el nombre real de tu tabla

    //
    protected $fillable = [
        'nombre',
        'apellido',
        'curp',
        'telefono',
        'email',
        'tipo_cliente',
        'status',
        'registro',
    ];
}
