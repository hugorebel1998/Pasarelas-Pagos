<?php

namespace App\Factories;

use App\Models\Pago;
use App\Models\Solicitud;
use App\Models\Usuario as ModelsUsuario;
use Exception;

class Usuario
{

    public static function select(string|null $usuario_id)
    {
        if (empty($usuario_id))
            return ModelsUsuario::all();

        return ModelsUsuario::findOrFail($usuario_id);
    }

    public static function create(array $usuario)
    {
        return ModelsUsuario::create($usuario);
    }

    public static function update(object $usuario_db, array $usuario)
    {

        $usuario_db->fill($usuario);

        $usuario_db->save();

        return $usuario_db;
    }

    public static function delete(string $usuario_id)
    {
        $usuario_db = ModelsUsuario::findOrFail($usuario_id);

        $usuario_db->delete();

        return $usuario_db;
    }

    public static function restore($usuario_id)
    {
        ModelsUsuario::onlyTrashed()->findOrFail($usuario_id)->restore();

        return response()->json(['success' => true, 'message' => 'Usuario restablecido'], 200);
    }

    public static function restorePassword(string $usuario_id, array $usuario)
    {
        $usuario_db = ModelsUsuario::findOrFail($usuario_id);

        if (!password_verify($usuario['password'], $usuario_db['password']))
            throw new Exception('La contraseñas no coinciden');

        $usuario_db->password = $usuario['nueva_contrasena'];
        $usuario_db->save();

        return response()->json(['success' => true, 'message' => 'Contraseña actualizada con éxito'], 200);
    }

    public static function payments(string $usuario_id)
    {
        return Pago::whereHas('solicitud', function ($query) use ($usuario_id) {

            $query->where('usuario_id', $usuario_id);
        })->get();
    }
}
