<?php

namespace App\Factories;

use App\Factories\Pagos\Paypal;
use App\Models\Pago as ModelsPago;
use App\Models\Solicitud;

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

        if ($pago['pasarela_pago'] === 'paypal' && $solicitud_db['estatus'] === Solicitud::ESTATUS_PENDIENTE) {

            // Se invoca al Factorie de crear orden en paypal
            return Paypal::createOrder($pago);
        } else if ($pago['pasarela_pago'] === 'stripe' && $solicitud_db['estatus'] === Solicitud::ESTATUS_PENDIENTE) {
            // Se invoca al Factorie de crear orden en stipe

            return 'No éxiste logica aun';
        }
    }

    public static function paypalWebhook(array $orden)
    {
        return Paypal::webhook($orden);
    }
}
