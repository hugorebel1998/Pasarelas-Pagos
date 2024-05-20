<?php

namespace App\Factories;

use App\Services\PaypalService;

class Paypal
{
    public static function create(array $pago)
    {

        $service = app(PaypalService::class)->crearOrden([
            'intent' => 'CAPTURE',
            'purchase_units' => [
                [
                    'items' => [
                        [
                            'name' => 'PAGO FORMULARIO',
                            'description' => strtolower($pago['referencia_de_pago']),
                            'quantity' => 1,
                            'unit_amount' => [
                                'currency_code' => strtoupper($pago['moneda']),
                                'value' => intval($pago['monto_a_pagar']),

                            ]

                        ]
                    ],
                    'amount' => [
                        'currency_code' => strtoupper($pago['moneda']),
                        'value' => intval($pago['monto_a_pagar']),
                        'breakdown' => [
                            'item_total' => [
                                'currency_code' => strtoupper($pago['moneda']),
                                'value' => intval($pago['monto_a_pagar']),
                            ]

                        ]

                    ]
                ]
            ],
            'application_context' => [
                'return_url' => 'https://example.com/return',
                'cancel_ur' =>  'https://example.com/cancel'
            ]
        ]);

        return $service;
    }
}
