<?php

namespace App\Http\Controllers\V1\Catalogos;

use App\Factories\Catalogo;
use App\Http\Controllers\Controller;
use App\Models\Catalogo as ModelsCatalogo;
use Illuminate\Http\Request;

class CatalogoController extends Controller
{
    public  function listar($catalogo_id = null)
    {
        return Catalogo::select($catalogo_id);
    }

    public  function byCodigo($codigo)
    {
        return Catalogo::codigo($codigo);
    }

    public function crear(Request $request)
    {
        $catalogo = $this->validate($request, [
            'nombre'       => 'required|min:2|max:60',
            'codigo'       => 'required|unique:catalogos,codigo',
            'descripcion'  => 'required',
            'opciones'     => 'sometimes|array|min:1',
            'opciones.*.nombre'  => 'required',
            'opciones.*.valor'   => 'required',
        ]);

        return Catalogo::create($catalogo);
    }

    public function actualizar(Request $request, $catalogo_id)
    {
        $catalogo_db = ModelsCatalogo::findOrFail($catalogo_id);

        $catalogo = $this->validate($request, [
            'nombre'       => 'sometimes|min:2|max:60',
            'codigo'       => 'sometimes|unique:catalogos,codigo,' . $catalogo_db->id,
            'descripcion'  => 'sometimes',
            'opciones.'     => 'sometimes|array|min:1',
            'opciones.*.id'  => 'sometimes',
            'opciones.*.nombre'  => 'required_without:opciones.*.id',
            'opciones.*.valor'   => 'required_without:opciones.*.id',
            'opciones.*.estatus' => 'sometimes|boolean'
        ]);

        return Catalogo::update($catalogo_db, $catalogo);
    }
}
