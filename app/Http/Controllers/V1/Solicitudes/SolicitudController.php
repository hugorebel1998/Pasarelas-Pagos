<?php

namespace App\Http\Controllers\V1\Solicitudes;

use App\Factories\Solicitud;
use App\Http\Controllers\Controller;
use App\Models\Solicitud as ModelsSolicitud;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class SolicitudController extends Controller
{
    public function listar($solicitud_id = null)
    {
        return Solicitud::select($solicitud_id);
    }

    public function crear(Request $request)
    {

        $usuario_db = Auth::user();
        $request->request->add(['usuario_id' => $usuario_db['id']]);

        $solicitud = $this->validate($request, [
            'usuario_id' => 'required|exists:usuarios,id',
            'nombre'   => 'required|min:2|max:60',
            'apellidos'  => 'required|min:2|max:100',
            'fecha_nacimiento'  => 'required',
            'anio_escolar' => 'required',
            'nombre_tutor'    => 'required|min:2|max:60',
            'apellidos_tutor' => 'required|min:2|max:100',
            'parentesco' => 'required|' . Rule::in(ModelsSolicitud::PARENTESCO_PERSONA),
            'email' => 'required',
            'telefono' => 'required|min:10|max:13',
            'nombre_colegio' => 'required',
            'monto_a_pagar' => 'required',
            'referencia_pago' => 'required',
            'ciclo_viaje_clave' => 'required',
            'pais_clave' => 'required',
            'programa_clave' => 'required'
        ]);

        return Solicitud::create($solicitud);
    }

    public function actualizar(Request $request, $solicitud_id)
    {

        $solicitud_db = ModelsSolicitud::findOrFail($solicitud_id);

        $solicitud = $this->validate($request, [
            'nombre'   => 'sometimes|min:2|max:60',
            'apellidos'  => 'sometimes|min:2|max:100',
            'fecha_nacimiento'  => 'sometimes',
            'anio_escolar' => 'sometimes',
            'nombre_tutor'    => 'sometimes|min:2|max:60',
            'apellidos_tutor' => 'sometimes|min:2|max:100',
            'parentesco' => 'sometimes|' . Rule::in(ModelsSolicitud::PARENTESCO_PERSONA),
            'email' => 'sometimes',
            'telefono' => 'sometimes|min:10|max:13',
            'nombre_colegio' => 'sometimes',
            'monto_a_pagar' => 'sometimes',
            'referencia_pago' => 'sometimes',
            'ciclo_viaje_clave' => 'sometimes',
            'pais_clave' => 'sometimes',
            'programa_clave' => 'sometimes'
        ]);

        return Solicitud::update($solicitud_db, $solicitud);
    }
}
