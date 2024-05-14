<?php

namespace App\Http\Controllers\V1\PasarelaDePagos;

use App\Factories\PasarelaDePago;
use App\Http\Controllers\Controller;
use App\Models\PasarelaDePago as ModelsPasarelaDePago;
use Illuminate\Http\Request;

class PasarelaDePagosController extends Controller
{

    public function listar($viadepago_id = null)
    {
        return PasarelaDePago::select($viadepago_id);
    }

    public function crear(Request $request)
    {
        $viadepago = $this->validate($request, [
            'nombre' => 'required|unique:via_de_pagos,nombre',
            'url' => 'required|unique:via_de_pagos,url',
            'cliente_key' => 'required',
            'cliente_secret' => 'required',
        ]);

        return PasarelaDePago::create($viadepago);
    }

    public function actualizar(Request $request, $viadepago_id)
    {

        $viadepago_db = ModelsPasarelaDePago::findOrFail($viadepago_id);

        $viadepago = $this->validate($request, [
            'nombre' => 'sometimes|unique:via_de_pagos,nombre,' . $viadepago_db->id,
            'url' => 'sometimes|unique:via_de_pagos,url,' . $viadepago_db->id,
            'cliente_key' => 'sometimes',
            'cliente_secret' => 'sometimes',
        ]);

        return PasarelaDePago::update($viadepago_db, $viadepago);
    }
}
