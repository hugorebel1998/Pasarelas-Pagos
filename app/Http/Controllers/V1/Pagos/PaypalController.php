<?php

namespace App\Http\Controllers\V1\Pagos;

use App\Factories\Paypal;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class PaypalController extends Controller
{

    public function crear(Request $request, $solicitud_id)
    {
        $request->request->add(['solicitud_id' => $solicitud_id]);

        $pago = $this->validate($request, [
            'solicitud_id'  => 'required|exists:solicitudes,id',
            'pasarela_clave'   => 'required',
            'metodo_pago'   => 'required|in:debito,credito', //Tipo de tarjeta débito o crédito
            'monto_a_pagar' => 'required',
            'referencia_de_pago' => 'required',
            'moneda'       => 'required',
            'url_exito'    => 'sometimes',
            'url_error'    => 'sometimes'
        ]);

        return Paypal::create($pago);
    }

    public function success()
    {
        return response()->json(['La respuesta fue un exito'], 200);
    }

    public function error()
    {
        return response()->json(['La respuesta falo'], 401);
    }

    public function webhook(Request $request)
    {
        Log::info(print_r($request->all(), true));

        return $request->all();
    }
}
