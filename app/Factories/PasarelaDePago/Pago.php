<?php

namespace App\Factories\PasarelaDePago;

use App\Services\PaypalService;

class Pago
{

    // public static function select(string|null $pago_id)
    // {
    //     if (empty($pago_id))
    //         return Pago::all();

    //     return Pago::findOrFail($pago_id);
    // }

    public static function create(array $pago)
    {
        // return $request;
        $service = new PaypalService();

        $service->crearOrden([
            'intent' => 'CAPTURE',
            'purchase_units' => [
                [
                    'amount' => [
                        'currency_code' => strtoupper($pago['moneda']),
                        'value' => intval($pago['monto_a_pagar'])

                    ]
                ]
            ]
        ]);
    }
}
