<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUlids;


class Solicitud extends Model
{
    const PARENTESCO_PERSONA = ['Madre', 'Padre', 'Otro'];
    const ESTATUS_APROVADO  = 'aprobado';
    const ESTATUS_PENDIENTE = 'pendiente';
    const ESTATUS_RECHAZADO = 'rechazado';
    const ESTATUS_CANCELADO = 'cancelado';



    protected $table = 'solicitudes';

    protected $fillable = [
        'usuario_id',
        'nombre',
        'apellidos',
        'fecha_nacimiento',
        'anio_escolar',
        'nombre_tutor',
        'apellidos_tutor',
        'parentesco',
        'email',
        'telefono',
        'nombre_colegio',
        'monto_a_pagar',
        'referencia_pago',
        'ciclo_viaje_clave',
        'pais_clave',
        'programa_clave',
        'estatus',
    ];

    protected $hidden = [
        'updated_at',
    ];

    protected $appends = [
        'nombre_completo',
        'nombre_completo_tutor',
    ];


    protected $attributes = [
        'estatus' => self::ESTATUS_PENDIENTE
    ];


    use HasFactory, HasUlids;

    protected function nombreCompleto(): Attribute
    {
        return Attribute::make(
            get: fn () => implode(' ', array_values([$this->nombre, $this->apellidos]))
        );
    }

    protected function nombreCompletoTutor(): Attribute
    {
        return Attribute::make(
            get: fn () => implode(' ', array_values([$this->nombre_tutor, $this->apellidos_tutor]))
        );
    }

    protected function paisClave(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => strtolower($value)
        );
    }

    protected function programaClave(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => strtolower($value)
        );
    }
}
