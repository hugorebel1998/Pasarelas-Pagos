<?php

namespace App\Factories;

use App\Models\Cliente as ModelsCliente;
use Exception;

class Cliente
{

    public static function select(string|null $cliente_id)
    {
        if (empty($usuario_id))
            return ModelsCliente::all();

        return ModelsCliente::findOrFail($usuario_id);
    }

    public static function create(array $cliente)
    {
        return ModelsCliente::create($cliente);
    }

    public static function update(object $cliente_db, array $cliente)
    {

        $cliente_db->fill($cliente);

        $cliente_db->save();

        return $cliente_db;
    }


    public static function restorePassword(string $cliente_id, array $cliente)
    {
        $cliente_db = ModelsCliente::findOrFail($cliente_id);

        if (!password_verify($cliente['password'], $cliente_db['password']))
            throw new Exception('La contraseñas no coinciden');

        $cliente_db->password = $cliente['nueva_contrasena'];
        $cliente_db->save();

        return response()->json(['success' => true, 'message' => 'Contraseña actualizada con éxito'], 200);
    }

    
}
