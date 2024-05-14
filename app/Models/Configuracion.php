<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Configuracion extends Model
{

    protected $table = 'configuraciones';


    protected $fillable = [
        'nombre',
        'tipo',
        'valor',
        'descripcion',
        'estatus',
    ];

    protected $hidden = [
        'updated_at',
    ];


    use HasFactory, HasUlids;
}
