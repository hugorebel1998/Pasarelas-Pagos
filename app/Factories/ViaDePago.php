<?php

namespace App\Factories;

use App\Models\ViaDePago as ModelsViaDePago;

class ViaDePago
{

    public static function select(string|null $viadepago_id)
    {
        if (empty($viadepago_id))
            return ModelsViaDePago::all();

        return ModelsViaDePago::findOrFail($viadepago_id);
    }

    public static function create(array $viadepago)
    {

        return ModelsViaDePago::create($viadepago);
    }

    public static function update(object $viadepago_db, array $viadepago)
    {
        $viadepago_db->fill($viadepago);
        $viadepago_db->save();

        return $viadepago_db;
    }
}
