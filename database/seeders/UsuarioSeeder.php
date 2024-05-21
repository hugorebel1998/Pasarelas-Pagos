<?php

namespace Database\Seeders;

use App\Factories\Usuario;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (env('APP_ENV') !== 'production') {

            $usuario = [
                'nombre' => 'Admin',
                'paterno' => 'Admin',
                'materno' => 'Admin',
                'username' => 'it_admin_96',
                'email' => 'it_admin@hotmail.com',
                'password' => '12345678',
            ];

            Usuario::create($usuario);
        }
    }
}
