<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Encryption\Encrypter;


class Configuracion extends Model
{

    protected $table = 'configuraciones';

    protected $VALORES_ESPECIALES = ['PAYPAL_CLIENTE_KEY', 'PAYPAL_CLIENTE_SECRET', 'STRIPE_CLIENTE_KEY', 'STRIPE_CLIENTE_SECRET'];

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

    protected function valor(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => (
                in_array($this->nombre, $this->VALORES_ESPECIALES) ?
                (new Encrypter(env('KEY_ENCRYPT')))->encrypt($value) :
                $value
            )
        );
    }
}
