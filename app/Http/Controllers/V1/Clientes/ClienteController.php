<?php

namespace App\Http\Controllers\V1\Clientes;

use App\Factories\Cliente;
use App\Http\Controllers\Controller;
use App\Models\Cliente as ModelsCliente;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ClienteController extends Controller
{
    public function listar($cliente_id = null)
    {
        return Cliente::select($cliente_id);
    }

    public function crear(Request $request)
    {
        $cliente = $this->validate($request, [
            'nombre'   => 'required|min:2|max:60',
            'paterno'  => 'required|min:2|max:60',
            'materno'  => 'required|min:2|max:60',
            'email'    => 'required|unique:usuarios,email',
            'password' => 'required|min:8|confirmed',
            'fecha_nacimiento' => 'required',
            'nombre_tutor' => 'required|min:2|max:60',
            'apellidos_tutor' => 'required|min:2|max:60',
            'parentesco' => 'required|' . Rule::in(ModelsCliente::PARENTESCO),
            'telefono' => 'required|min:10|max:13',
        ]);

        return Cliente::create($cliente);
    }

    public function actualizar(Request $request, $cliente_id)
    {
        $cliente_db = ModelsCliente::findOrFail($cliente_id);

        $cliente = $this->validate($request, [
            'nombre'   => 'sometimes|min:2|max:60',
            'paterno'  => 'sometimes|min:2|max:60',
            'materno'  => 'sometimes|min:2|max:60',
            'email'    => 'sometimes|unique:usuarios,email|unique:clientes,email,' . $cliente_db->id,
            'fecha_nacimiento' => 'sometimes',
            'nombre_tutor' => 'sometimes|min:2|max:60',
            'apellidos_tutor' => 'sometimes|min:2|max:60',
            'parentesco' => 'sometimes|' . Rule::in(ModelsCliente::PARENTESCO),
            'telefono' => 'sometimes|min:10|max:13',
        ]);

        return Cliente::update($cliente_db, $cliente);
    }

    public function restablecerContrasena(Request $request, $cliente_id)
    {
        $cliente = $this->validate($request, [
            'password'   => 'required',
            'nueva_contrasena' => 'min:8|required_with:confirmar_nueva_contrasena|same:confirmar_nueva_contrasena',
            'confirmar_nueva_contrasena' => 'required|min:8'
        ]);

        return Cliente::restorePassword($cliente_id, $cliente);
    }
}
