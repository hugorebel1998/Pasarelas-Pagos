<?php

namespace App\Http\Controllers\V1\Configuracion;

use App\Factories\Configuracion;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ConfiguracionController extends Controller
{
    public function listar($configuracion_id = null)
    {
        return Configuracion::select($configuracion_id);
    }

    public function crear(Request $request)
    {
        $configuracion = $this->validate($request, [
            'nombre' => 'required|unique:configuraciones,nombre',
            'tipo' => 'required|in:string,number,numeric,array,object,json,boolean',
            'valor' => 'required',
            'descripcion' => 'required|max:1000',
            'estatus' => 'sometimes|boolean'
        ]);

        return Configuracion::create($configuracion);
    }

    public function actualizar(Request $request, $configuracion_id)
    {
        $configuracion = $this->validate($request, [
            'tipo' => 'sometimes|in:string,number,numeric,array,object,json,boolean',
            'valor' => 'sometimes|required',
            'descripcion' => 'sometimes|max:1000',
            'estatus' => 'sometimes|boolean'
        ]);

        return Configuracion::update($configuracion_id, $configuracion);
    }
}
