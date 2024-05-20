<?php

namespace App\Http\Controllers\V1\PasarelaDePagos;

use App\Factories\PasarelaDePago;
use App\Http\Controllers\Controller;
use App\Models\PasarelaDePago as ModelsPasarelaDePago;
use Illuminate\Http\Request;

class PasarelaDePagosController extends Controller
{

    public function listar($pasarela_id = null)
    {
        return PasarelaDePago::select($pasarela_id);
    }

    public function crear(Request $request)
    {
        $pasarela = $this->validate($request, [
            'nombre' => 'required|unique:via_de_pagos,nombre',
            'url' => 'required|unique:via_de_pagos,url',
            'cliente_key' => 'required',
            'cliente_secret' => 'required',
        ]);

        return PasarelaDePago::create($pasarela);
    }

    public function actualizar(Request $request, $pasarela_id)
    {

        $pasarela_db = ModelsPasarelaDePago::findOrFail($pasarela_id);

        $pasarela = $this->validate($request, [
            'nombre' => 'sometimes|unique:via_de_pagos,nombre,' . $pasarela_db->id,
            'url' => 'sometimes|unique:via_de_pagos,url,' . $pasarela_db->id,
            'cliente_key' => 'sometimes',
            'cliente_secret' => 'sometimes',
        ]);

        return PasarelaDePago::update($pasarela_db, $pasarela);
    }
}
