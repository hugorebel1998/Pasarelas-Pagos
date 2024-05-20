<?php

namespace App\Factories;

use App\Models\PasarelaDePago as ModelsPasarelaDePago;

class PasarelaDePago
{

    public static function select(string|null $pasarela_id)
    {
        if (empty($pasarela_id))
            return ModelsPasarelaDePago::all();

        return ModelsPasarelaDePago::findOrFail($pasarela_id);
    }

    public static function create(array $pasarela)
    {

        return ModelsPasarelaDePago::create($pasarela);
    }

    public static function update(object $pasarela_db, array $pasarela)
    {
        $pasarela_db->fill($pasarela);
        $pasarela_db->save();

        return $pasarela_db;
    }
}
