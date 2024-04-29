<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Model;

class Catalogo extends Model
{
    protected $table = 'catalogos';

    protected $fillable = [
        'nombre',
        'codigo',
        'descripcion',
        'estatus',
    ];

    protected $hidden = [
        'updated_at',
    ];

    use HasFactory, HasUlids;

    protected function codigo(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => strtolower($value),
            set: fn ($value) => normalizer_normalize($value)
        );
    }

    public function opciones()
    {
        return $this->hasMany(Catalogo\Opcion::class);
    }
}
