<?php

namespace App\Factories;

use App\Models\PasarelaDePago as ModelsPasarelaDePago;

class PasarelaDePago
{

    public static function select(string|null $viadepago_id)
    {
        if (empty($viadepago_id))
            return ModelsPasarelaDePago::all();

        return ModelsPasarelaDePago::findOrFail($viadepago_id);
    }

    public static function create(array $viadepago)
    {

        return ModelsPasarelaDePago::create($viadepago);
    }

    public static function update(object $viadepago_db, array $viadepago)
    {
        $viadepago_db->fill($viadepago);
        $viadepago_db->save();

        return $viadepago_db;
    }
}
