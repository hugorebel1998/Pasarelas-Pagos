<?php

namespace App\Http\Controllers\V1\Usuarios;

use App\Factories\Usuario;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Usuario as ModelsUsuario;
use Illuminate\Support\Facades\Auth;

class UsuarioController extends Controller
{
    public function listar($usuario_id = null)
    {
        return Usuario::select($usuario_id);
    }

    public function crear(Request $request)
    {
        $usuario = $this->validate($request, [
            'nombre'   => 'required|min:2|max:60',
            'paterno'  => 'required|min:2|max:60',
            'materno'  => 'required|min:2|max:60',
            'username' => 'required|min:5|max:30|unique:usuarios,username',
            'email'    => 'required|unique:usuarios,email',
            'password' => 'required|min:8|confirmed',
        ]);

        return Usuario::create($usuario);
    }

    public function actualizar(Request $request, $usuario_id)
    {
        $usuario_db = ModelsUsuario::findOrFail($usuario_id);

        $usuario = $this->validate($request, [
            'nombre'   => 'sometimes|min:2|max:60',
            'paterno'  => 'sometimes|min:2|max:60',
            'materno'  => 'sometimes|min:2|max:60',
            'username' => 'sometimes|min:5|max:30|unique:usuarios,username,' . $usuario_db->id,
            'email'    => 'sometimes|unique:usuarios,email,' . $usuario_db->id,
        ]);

        return Usuario::update($usuario_db, $usuario);
    }

    public function eliminar($usuario_id)
    {
        return Usuario::delete($usuario_id);
    }

    public function restablecer($usuario_id)
    {
        return Usuario::restore($usuario_id);
    }

    public function restablecerContrasena(Request $request, $usuario_id)
    {
        $usuario = $this->validate($request, [
            'password'   => 'required',
            'nueva_contrasena' => 'min:8|required_with:confirmar_nueva_contrasena|same:confirmar_nueva_contrasena',
            'confirmar_nueva_contrasena' => 'required|min:8'
        ]);

        return Usuario::restorePassword($usuario_id, $usuario);
    }

    public function listarPagos()
    {
        $usuario_id = Auth::id();
        
        return Usuario::payments($usuario_id);
    }
}
