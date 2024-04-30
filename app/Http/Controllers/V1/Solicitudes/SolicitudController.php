<?php

namespace App\Http\Controllers\V1\Solicitudes;

use App\Factories\Solicitud;
use App\Http\Controllers\Controller;
use App\Models\Solicitud as ModelsSolicitud;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class SolicitudController extends Controller
{
    public function listar($solicitud_id = null)
    {
        return Solicitud::select($solicitud_id);
    }

    public function crear(Request $request)
    {

        $solicitud = $this->validate($request, [
            'nombre'   => 'required|min:2|max:60',
            'apellidos'  => 'required|min:2|max:100',
            'fecha_nacimiento'  => 'required',
            'anio_escolar' => 'required',
            'nombre_tutor'    => 'required|min:2|max:60',
            'apellidos_tutor' => 'required|min:2|max:100',
            'parentesco' => 'required|'. Rule::in(ModelsSolicitud::PARENTESCO_PERSONA),
            'email' => 'required',
            'telefono' => 'required|min:10|max:13',
            'nombre_colegio' => 'required',
            'monto_a_pagar' => 'required',
            'referencia_pago' => 'required',
            'moneda_clave' => 'required',
            'ciclo_viaje_clave' => 'required',
            'pais_clave' => 'required',
            'programa_clave' => 'required'
        ]);

        return Solicitud::create($solicitud);
    }
}
