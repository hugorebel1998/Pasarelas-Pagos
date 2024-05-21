<?php

namespace App\Http\Controllers\V1\Pagos;

use App\Factories\Pagos;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PagosController extends Controller
{
    public function listar($solicitud_id = null)
    {
        return Pagos::select($solicitud_id);
    }

    public function crear(Request $request, $solicitud_id)
    {
        $request->request->add(['solicitud_id' => $solicitud_id]);

        $pago = $this->validate($request, [
            'solicitud_id'  => 'required|exists:solicitudes,id',
            'pasarela_pago' => 'required|in:paypal,stripe',
            'metodo_pago'   => 'required|in:debito,credito',
            'monto_a_pagar' => 'required',
            'referencia_de_pago' => 'required',
            'moneda'       => 'required'
        ]);

        return Pagos::crear($pago);
    }

    public function success()
    {
        return response()->json(['Felicidades'], 200);
    }

    public function error()
    {
        return response()->json(['Ocurio un error'], 404);
    }

    public function webhook(Request $request)
    {
        Log::info([$request->all()]);
        $orden = $request->all();

        return Pagos::paypalWebhook($orden);
    }
}
