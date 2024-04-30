<?php

namespace Database\Seeders;

use App\Models\Catalogo;
use App\Models\Catalogo\Opcion;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CatalogosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (env('APP_ENV') !== 'production') {
            $paises = [
                'Argentina',
                'Brazil',
                'Chile',
                'Colombia',
                'Costa Rica',
                'Ecuador',
                'Egypt',
                'El Salvador',
                'Guatemala',
                'Mexico',
                'Panama',
                'Paraguay',
                'Peru',
                'Uruguay',
                'Venezuela',
            ];

            $catalogo_db = Catalogo::create([
                'nombre' => 'Paises',
                'codigo' => 'paises',
                'descripcion' => 'Catalogo de paises disponibles',
            ]);

            foreach ($paises as $pais) {
                Opcion::create([
                    'catalogo_id' => $catalogo_db['id'],
                    'nombre' => $pais,
                    'valor' => $pais,
                ]);
            }



            $catalogo_db = Catalogo::create([
                'nombre' => 'Programas',
                'codigo' => 'programas',
                'descripcion' => 'Catalogo de programas disponibles',
            ]);

            $programas = [
                'BEO',
                'MASTER',
                'WEE',
                'OXFORD TCC',
                'Kick off Buenos Aires',
                'GEAR',
                'Further Education',
                'ETG Ambassadors',
                'B+'
            ];


            foreach ($programas as $programa) {
                Opcion::create([
                    'catalogo_id' => $catalogo_db['id'],
                    'nombre' => $programa,
                    'valor'  => $programa,
                ]);
            }
        }
    }
}
