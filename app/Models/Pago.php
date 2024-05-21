<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUlids;

class Pago extends Model
{

    protected $table = 'pagos';

    protected $fillable = [
        'solicitud_id',
        'pasarela_pago',
        'orden_id',
        'pago_id',
        'tipo_moneda',
        'cantidad_pagada',
        'estatus',
        'nombre_pagador',
        'email_pagador',
        'solicitud_id',
    ];

    use HasFactory, HasUlids;
}
