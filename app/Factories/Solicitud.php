<?php

namespace App\Factories;

use App\Models\Solicitud as ModelsSolicitud;

class Solicitud
{

    public static function select(string|null $solicitud_id)
    {
        if (empty($solicitud_id))
            return ModelsSolicitud::orderBy('id', 'desc')->get()    ;

        return ModelsSolicitud::findOrFail($solicitud_id);
    }

    public static function create(array $solicitud)
    {
        return ModelsSolicitud::create($solicitud);
    }

    public static function update(object $solicitud_db, array $solicitud)
    {
        $solicitud_db->fill($solicitud);

        $solicitud_db->save();

        return $solicitud_db;
    }
}
