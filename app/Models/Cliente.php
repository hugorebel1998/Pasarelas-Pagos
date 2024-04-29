<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    const ESTATUS_ACTIVO   = 'activo';
    const ESTATUS_INACTIVO = 'inactivo';

    const PARENTESCO = ['Madre', 'Padre', 'Otro'];

    protected $table = 'clientes';

    protected $fillable = [
        'nombre',
        'paterno',
        'materno',
        'email',
        'fecha_nacimiento',
        'nombre_tutor',
        'apellidos_tutor',
        'parentesco',
        'telefono',
        'estatus',
        'password'
    ];

    protected $appends = [
        'nombre_completo'
    ];

    protected $attributes = [
        'estatus' => self::ESTATUS_ACTIVO
    ];

    protected $hidden = [
        'updated_at',
        'password',
    ];

    protected $casts = [
        'password' => 'hashed'
    ];


    use HasFactory, HasUlids;

    protected function nombreCompleto(): Attribute
    {
        return Attribute::make(
            get: fn () => implode(' ', array_values([$this->nombre, $this->paterno, $this->materno]))
        );
    }
}
