<?php

namespace App\Factories\Catalogo;

use App\Models\Catalogo\Opcion as ModelsOpcion;
use App\Models\Catalogo as ModelsCatalogo;

class Opciones
{
    public static function select(string $catalogo_id, string|null $opcion_id)
    {
        if (empty($opcion_id))
            return ModelsOpcion::where('catalogo_id', $catalogo_id)->get();

        return ModelsOpcion::where('catalogo_id', $catalogo_id)->findOrFail($opcion_id);
    }

    public static function create(array $opcion)
    {
        return ModelsOpcion::create($opcion);
    }

    public static function update(string $opcion_id, array $opcion)
    {
        $opcion_db = ModelsOpcion::findOrFail($opcion_id);

        $opcion_db->fill($opcion)->save();

        return $opcion_db;
    }

    public static function createAll(object $catalogo_db, array $opciones)
    {
        $catalogo_db = ModelsCatalogo::findOrFail($catalogo_db->id);

        $catalogo_db->opciones()->createMany($opciones);

        $catalogo_db->load('opciones');

        return $catalogo_db;
    }

    public static function updateMany(object $catalogo_db, array $opciones)
    {
        $catalogo_db = ModelsCatalogo::findOrFail($catalogo_db->id);

        foreach($opciones as $opcion) {
            self::update($opcion['id'], $opcion);
        }
    }
}
