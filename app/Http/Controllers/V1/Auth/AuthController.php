<?php

namespace App\Http\Controllers\V1\Auth;

use App\Factories\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function inicioSesion(Request $request)
    {
        $usuario = $this->validate($request, [
            'email'     => 'required',
            'password'  => 'required',
        ]);

        return Auth::login($usuario);
    }

    public function registrar(Request $request)
    {
        $usuario = $this->validate($request, [
            'nombre'   => 'required|min:2|max:60',
            'paterno'  => 'required|min:2|max:60',
            'materno'  => 'required|min:2|max:60',
            'username' => 'required|min:5|max:30|unique:usuarios,username',
            'email'    => 'required|unique:usuarios,email',
            'password' => 'required|min:8|confirmed',
        ]);

        return Auth::register($usuario);
    }

    public function refrescarToken(Request $request)
    {
        $token = $this->validate($request, [
            'token' => 'required',
            'usuario_id' => 'required',
        ]);

        return Auth::refreshToken($token);
    }
}
