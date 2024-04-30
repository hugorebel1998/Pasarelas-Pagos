<?php

namespace App\Http\Controllers\V1\Catalogos;

use App\Factories\Catalogo\Opciones;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OpcionController extends Controller
{

    public function listar($catalogo_id, $opcion_id = null)
    {
        return Opciones::select($catalogo_id, $opcion_id);
    }

    public function crear(Request $request, $catalogo_id)
    {
        $request->request->add(['catalogo_id' => $catalogo_id]);

        $opcion = $this->validate($request, [
            'catalogo_id'  => 'required|exists:catalogos,id',
            'nombre'       => 'required|min:2|max:60',
            'valor'        => 'required',
        ]);

        return Opciones::create($opcion);
    }

    public function actualizar(Request $request, $catalogo_id, $opcion_id)
    {

        $request->request->add(['catalogo_id' => $catalogo_id]);

        $opcion = $this->validate($request, [
            'catalogo_id'  => 'required|exists:catalogos,id',
            'nombre'       => 'sometimes|min:2|max:60',
            'valor'        => 'sometimes',
        ]);

        return Opciones::update($opcion_id, $opcion);

    }
}
