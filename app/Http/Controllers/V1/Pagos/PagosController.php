<?php

namespace App\Http\Controllers\V1\Pagos;

use App\Factories\Paypal;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PagosController extends Controller
{

    // public function listar($pagos_id = null)
    // {
    //     if (empty($pagos_id))
    //         return Pagos::all();

    //     return Pagos::findOrFail($pagos_id);
    // }

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
        ]);

        return Paypal::create($pago);
    }
}
