<?php

namespace Database\Seeders;

use App\Models\Catalogo;
use App\Models\Catalogo\Opcion;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CatalogosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        // Deshabilitar las comprobaciones de claves foráneas
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // Limpiar los datos de la tabla catalogos
        Catalogo::truncate();
        // Limpiar los datos de la tabla catalogo_opciones
        Opcion::truncate();

        // Habilitar las comprobaciones de claves foráneas
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');


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

        $catalogo_db = Catalogo::create([
            'nombre' => 'Divisas',
            'codigo' => 'divisas',
            'descripcion' => 'Catalogo de divisas "monedas" disponibles',
        ]);

        $modenas = [
            'EUR', // euro 
            'USD', // dólar estadounidense
            'MXN', // peso mexicano
            'BRL', // real brasileño
            'CAD', // dólar canadiense
        ];

        foreach ($modenas as $moneda) {
            Opcion::create([
                'catalogo_id' => $catalogo_db['id'],
                'nombre' => $moneda,
                'valor'  => $moneda,
            ]);
        }
    }
}
