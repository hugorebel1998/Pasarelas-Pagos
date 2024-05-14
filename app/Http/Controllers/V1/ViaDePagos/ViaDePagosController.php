<?php

namespace App\Http\Controllers\V1\ViaDePagos;

use App\Factories\ViaDePago;
use App\Http\Controllers\Controller;
use App\Models\ViaDePago as ModelsViaDePago;
use Illuminate\Http\Request;

class ViaDePagosController extends Controller
{

    public function listar($viadepago_id = null)
    {
        return ViaDePago::select($viadepago_id);
    }

    public function crear(Request $request)
    {
        $viadepago = $this->validate($request, [
            'nombre' => 'required|unique:via_de_pagos,nombre',
            'url' => 'required|unique:via_de_pagos,url',
            'cliente_key' => 'required',
            'cliente_secret' => 'required',
        ]);

        return ViaDePago::create($viadepago);
    }

    public function actualizar(Request $request, $viadepago_id)
    {

        $viadepago_db = ModelsViaDePago::findOrFail($viadepago_id);

        $viadepago = $this->validate($request, [
            'nombre' => 'sometimes|unique:via_de_pagos,nombre,' . $viadepago_db->id,
            'url' => 'sometimes|unique:via_de_pagos,url,' . $viadepago_db->id,
            'cliente_key' => 'sometimes',
            'cliente_secret' => 'sometimes',
        ]);

        return ViaDePago::update($viadepago_db, $viadepago);
    }
}
