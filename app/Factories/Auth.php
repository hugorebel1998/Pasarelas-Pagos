<?php

namespace App\Factories;

use App\Models\Usuario as ModelsUsuario;
use Firebase\JWT\JWT;
use Carbon\Carbon;
use Exception;

class Auth
{

    public static  function login(array $usuario)
    {
        $usuario_db = ModelsUsuario::where('email', $usuario['email'])->where('estatus', ModelsUsuario::ESTATUS_ACTIVO)->first();

        if (!$usuario_db)
            throw new Exception('Usuario o contraseña invalido', 401);

        if (!password_verify($usuario['password'], $usuario_db['password']))
            throw new Exception('La contraseña no coincide', 401);


        $token_fecha_creacion = Carbon::now()->timestamp;
        $toke_life = time() + intval(env('TOKEN_LIFE'));
        $token_secret = env('TOKEN_SECRET');
        $token_algoritmo = env('TOKEN_ALGORITMO');


        $payload = [
            'exp' => $toke_life,  //Expiración de token 1h
            'iat' => $token_fecha_creacion, // Hora en la que se crea el token formato UNIX
            'data' => [
                'usuario_id'  => $usuario_db['id'],
                'username'    => $usuario_db['username'],
                'nombre_completo' => $usuario_db['nombre_completo'],
                'email'       => $usuario_db['email'],
                'estatus'     => $usuario_db['estatus'],
            ]
        ];

        $token = JWT::encode($payload, $token_secret, $token_algoritmo);

        if (!$token)
            throw new Exception('No es posible iniciar sesión, comunicate con tu administrador', 500);

        return [
            'exp' => $toke_life,
            'iat' => $token_fecha_creacion,
            'data' => [
                'token' => $token
            ]
        ];
    }

    public static function register(array $usuario)
    {
        return Usuario::create($usuario);
    }
}
