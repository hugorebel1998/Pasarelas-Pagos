<?php

namespace App\Models\Catalogo;

use App\Models\Catalogo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Model;

class Opcion extends Model
{
    protected $table = 'catalogo_opciones';

    protected $fillable = [
        'catalogo_id',
        'nombre',
        'valor',
    ];

    protected $hidden = [
        'updated_at',
    ];

    use HasFactory, HasUlids;
}
