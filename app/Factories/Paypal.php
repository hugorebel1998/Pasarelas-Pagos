<?php

namespace App\Factories;

use App\Services\PaypalService;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class Paypal
{
    public static function create(array $pago)
    {
        try {
            $orden = app(PaypalService::class)->crearOrden([
                'intent' => 'CAPTURE',
                'purchase_units' => [
                    [
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
                ]
            ]);

            $usuario = Auth::user();

            $confirmar_orden = app(PaypalService::class)->confirmarOrden($orden['id'], [
                'payment_source' => [
                    'paypal' => [
                        'name' => [
                            'given_name' => $usuario['nombre'],
                            'surname' => $usuario['patreno'] . '' . $usuario['materno'],
                        ],
                        'email_address' => $usuario['email'],
                        'experience_context' => [
                            'payment_method_preference' => 'IMMEDIATE_PAYMENT_REQUIRED',
                            'brand_name' => env('APP_NAME'),
                            'shipping_preferenc' => 'NO_SHIPPING',
                            'user_action' => 'PAY_NOW',
                            'return_url' => route('paypal.success'),
                            'cancel_url' => route('paypal.error')
                        ]

                    ]
                ]
            ]);

            $link_pago = '';
            $links = $confirmar_orden['links'];
            foreach ($links as $link) {
                if ($link['rel'] === 'payer-action')
                    $link_pago = $link['href'];
            }


            return response()->json(['success' => true, 'menssage' => 'Orden capturada con éxito', 'link_pago' => $link_pago]);
        } catch (Exception $e) {
            Log::error($e);
            return $e->getMessage();
        }
    }
}
