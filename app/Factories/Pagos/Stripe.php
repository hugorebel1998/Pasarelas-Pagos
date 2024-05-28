<?php

namespace App\Factories\Pagos;

use App\Mail\NotificacionPagos;
use App\Models\Pago;
use App\Models\Solicitud;
use App\Services\StripeService;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class Stripe
{

    public static function createOrder(array $pago)
    {
        try {
            $usuario = Auth::user();

            $stripe_orden = app(StripeService::class)->createSesion([
                'client_reference_id' => $usuario['id'],
                'payment_method_types' => ['card'],
                'payment_intent_data' => [
                    'description' => $pago['referencia_de_pago']
                ],
                'line_items' => [
                    [
                        'price_data' => [
                            'currency' => strtoupper($pago['moneda']),
                            'product_data' => [
                                'name' => env('APP_NAME')
                            ],
                            'unit_amount' => round($pago['monto_a_pagar'] * 100)
                        ],
                        'quantity' => 1
                    ]
                ],
                'customer_email' => $usuario['email'],
                'metadata' => [
                    'solicitud_id' => $pago['solicitud_id'],
                    'customer_name' => $usuario['nombre_completo'],
                ],
                'mode' => 'payment',
                'success_url' => route('pago.success'),
                'cancel_url' => route('pago.error')

            ]);

            // Se crea la primera parte del pago
            Pago::create([
                'solicitud_id'  => $pago['solicitud_id'],
                'pasarela_pago' => $pago['pasarela_pago'],
                'orden_id'      => $stripe_orden['id'],
            ]);
            return response()->json(['success' => true, 'menssage' => 'Orden capturada con éxito', 'link_pago' => $stripe_orden['url']]);
        } catch (Exception $e) {
            Log::error($e);
            return $e->getMessage();
        }
    }

    public static function webhook(array $orden)
    {

        DB::beginTransaction();
        try {
            $data =  $orden['data']['object'];

            $pago_db = Pago::where('orden_id', $data['id'])->first();

            $solicitud_db = Solicitud::where('id', $pago_db['solicitud_id'])->first();

            if (!$pago_db)
                return throw new Exception('El pago no coincide con el ID de Orden', 404);


            $pago_db->update([
                'pago_id' => $orden['id'],
                'tipo_moneda' => $data['currency'],
                'cantidad_pagada' => $data['amount_total'] / 100,
                'estatus' => $data['status'],
                'nombre_pagador' => $data['customer_details']['name'],
                'email_pagador' =>  $data['customer_details']['email'],
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
            Log::error($e);
            return $e->getMessage();
        }
    }
}
