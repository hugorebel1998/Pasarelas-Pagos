<?php

namespace App\Factories;

use App\Factories\Pagos\Paypal;
use App\Factories\Pagos\Stripe;
use App\Models\Pago as ModelsPago;
use App\Models\Solicitud;
use Exception;

class Pagos
{
    public static function select(null|string $solicitud_id)
    {
        if (empty($solicitud_id))
            return ModelsPago::all();

        return ModelsPago::where('solicitud_id', $solicitud_id)->first();
    }

    public static function crear(array $pago)
    {
        $solicitud_db = Solicitud::where('id', $pago['solicitud_id'])->first();

        if ($solicitud_db['estatus'] === Solicitud::ESTATUS_APROVADO)
            throw new Exception("La solicitud ya se encuentra aprovada", 404);


        if ($pago['pasarela_pago'] === 'paypal' && $solicitud_db['estatus'] === Solicitud::ESTATUS_PENDIENTE) {

            return Paypal::createOrder($pago);
        } else if ($pago['pasarela_pago'] === 'stripe' && $solicitud_db['estatus'] === Solicitud::ESTATUS_PENDIENTE) {

            return Stripe::createOrder($pago);
        }
    }

    public static function paypalWebhook(array $orden)
    {
        return Paypal::webhook($orden);
    }

    public static function stripeWebhook(array $orden)
    {
        return Stripe::webhook($orden);
    }
}
