<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Encryption\Encrypter;

class PasarelaDePago extends Model
{

    const ESTATUS_ACTIVO      = 'activo';
    const ESTATUS_PENDIENTE   = 'pendiente';
    const ESTATUS_INACTIVO    = 'inactivo';

    protected $table = 'via_de_pagos';

    protected $fillable = [
        'nombre',
        'url',
        'cliente_key',
        'cliente_secret',
        'estatus',
    ];

    protected $attributes = [
        'estatus' => self::ESTATUS_PENDIENTE
    ];

    protected $hidden = [
        'updated_at'
    ];


    use HasFactory, HasUlids;


    protected function nombre(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => strtolower($value)
        );
    }


    protected function clienteKey(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => (new Encrypter(env('KEY_ENCRYPT')))->encrypt($value)
        );
    }

    protected function clienteSecret(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => (new Encrypter(env('KEY_ENCRYPT')))->encrypt($value)
        );
    }
}
