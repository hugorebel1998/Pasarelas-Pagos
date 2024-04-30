<?php

namespace App\Factories;

use App\Models\Solicitud as ModelsSolicitud;

class Solicitud
{

    public static function select(string|null $solicitud_id)
    {
        if (empty($solicitud_id))
            return ModelsSolicitud::all();

        return ModelsSolicitud::findOrFail($solicitud_id);
    }

    public static function create(array $solicitud)
    {
        return ModelsSolicitud::create($solicitud);
    }
}
