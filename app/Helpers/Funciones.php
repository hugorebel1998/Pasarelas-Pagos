<?php

use App\Models\Configuracion;

if (!function_exists('confenv')) {

    function confenv($key, $defautl = null, $connection = null)
    {
        if (empty($connection))
            $connection = config('database.default');


        $configuracion_db = Configuracion::where('nombre', $key)->first();

        if (empty($configuracion_db))
            return $defautl;

        switch ($configuracion_db['tipo']) {
            case 'string':
            case 'number':
            case 'numeric':
                return !empty($configuracion_db['valor']) ? $configuracion_db['valor'] : $defautl;
                break;

            case 'array':
            case 'json':
            case 'object':
                return !empty($configuracion_db['valor']) ? json_decode($configuracion_db['valor'], true) : $defautl;
                break;

            case 'boolean':
                return boolval($configuracion_db['valor']);
                break;

            default:
                return !empty($configuracion_db['valor'] ? $configuracion_db['valor'] : $defautl);
        }
    }
}
