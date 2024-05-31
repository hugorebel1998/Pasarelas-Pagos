<?php

namespace App\Factories\Pagos;

use App\Mail\NotificacionPagos;
use App\Models\Pago;
use App\Models\Solicitud;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Services\PaypalService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;


class Paypal
{
    public static function createOrder(array $pago)
    {
        try {
            $usuario = Auth::user();

            $paypal_orden = app(PaypalService::class)->crearOrden([
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
                ],

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
                            'return_url' => env('RUTA_PAGO'),
                            'cancel_url' => env('RUTA_PAGO')
                        ]

                    ]
                ],
            ]);


            // $link_pago = '';
            $links = $paypal_orden['links'];
            if (!empty($links)) {

                foreach ($links as $link) {
                    if ($link['rel'] === 'payer-action')
                        $link_pago = $link['href'];
                }

                // Se crea la pripera parte del pago
                Pago::create([
                    'solicitud_id'  => $pago['solicitud_id'],
                    'pasarela_pago' => $pago['pasarela_pago'],
                    'orden_id'      => $paypal_orden['id'],
                ]);

                return response()->json(['success' => true, 'menssage' => 'Orden capturada con éxito', 'link_pago' => $link_pago]);
            }
        } catch (Exception $e) {
            Log::error($e);
            return $e->getMessage();
        }
    }

    public static function webhook(array $orden)
    {

        DB::beginTransaction();
        try {
            $pago_db = Pago::where('orden_id', $orden['resource']['id'])->first();

            $solicitud_db = Solicitud::where('id', $pago_db['solicitud_id'])->first();


            if (!$pago_db)
                return throw new Exception('El pago no coincide con el ID de Orden', 404);


            $pago_db->update([
                'pago_id'  => $orden['id'],
                'tipo_moneda' => $orden['resource']['purchase_units'][0]['amount']['currency_code'],
                'cantidad_pagada' => $orden['resource']['purchase_units'][0]['amount']['value'],
                'estatus' => $orden['resource']['status'],
                'nombre_pagador' => $orden['resource']['payer']['name']['given_name'] . ' ' . $orden['resource']['payer']['name']['surname'],
                'email_pagador' => $orden['resource']['payer']['email_address']
            ]);


            $solicitud_db->update([
                'estatus' => Solicitud::ESTATUS_APROVADO
            ]);

            Mail::to($pago_db['email_pagador'])->send(new NotificacionPagos($pago_db['nombre_pagador'], $pago_db['tipo_moneda'], $pago_db['cantidad_pagada']));

            DB::commit();

            return response()->json([
                'success' => true,
                'meessage' => 'Pago capturado conéxito'
            ]);
        } catch (Exception $e) {
            DB::rollback();
            Log::error($e->getMessage());
            return $e->getMessage();
        }
    }
}
