<?php

namespace App\Factories;

use App\Factories\Catalogo\Opciones;
use App\Models\Catalogo as ModelsCatalogo;

class Catalogo
{
    public static function select(string|null $catalogo_id)
    {
        if (empty($catalogo_id))
            return ModelsCatalogo::with('opciones')->get();

        return ModelsCatalogo::with('opciones')->findOrFail($catalogo_id);
    }

    public static function codigo($codigo)
    {
        return ModelsCatalogo::where('codigo', $codigo)->with('opciones')->first();
    }

    public static function create(array $catalogo)
    {
        $catalogo_db = ModelsCatalogo::create($catalogo);

        if (isset($catalogo['opciones']))
            Opciones::createAll($catalogo_db, $catalogo['opciones']);


        return ModelsCatalogo::with('opciones')->find($catalogo_db->id);
    }

    public static function update(object $catalogo_db, array $catalogo)
    {
        $catalogo_db->fill($catalogo)->save();

        if (isset($catalogo_db['opciones']))
            Opciones::updateMany($catalogo_db, $catalogo['opciones']);


        return $catalogo_db->load('opciones');
    }
}
