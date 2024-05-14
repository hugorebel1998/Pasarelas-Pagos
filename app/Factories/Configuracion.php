<?php

namespace App\Factories;

use App\Models\Configuracion as ModelsConfiguracion;
use Exception;

class Configuracion
{
    public static function select(string|null $configuracion_id)
    {
        if (empty($configuracion_id))
            return ModelsConfiguracion::all();

        return ModelsConfiguracion::findOrFail($configuracion_id);
    }

    public static function create(array $configuracion)
    {
        if (in_array($configuracion['tipo'], ['array', 'object', 'json'])) {
            json_decode($configuracion['valor']);

            if (json_last_error() !== JSON_ERROR_NONE)
                throw new Exception('El valor no es un JSON valio', 400);
        }

        return ModelsConfiguracion::create($configuracion);
    }

    public static function update(string $configuracion_id, array $configuracion)
    {
        $configuracion_db = ModelsConfiguracion::findOrFail($configuracion_id);

        if (in_array($configuracion['tipo'], ['array', 'object', 'json'])) {
            json_decode($configuracion['valor']);

            if (json_last_error() !== JSON_ERROR_NONE)
                throw new Exception('El valor no es un JSON valio', 400);


            $configuracion_db->fill($configuracion);
            $configuracion_db->save();
        }


        return ModelsConfiguracion::find($configuracion_id);
    }
}
