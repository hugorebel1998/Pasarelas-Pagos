<?php

namespace App\Services;

use Exception;
use Illuminate\Support\Facades\Log;

class PaypalService extends HttpCliente
{

    protected $baseUri = 'https://api-m.sandbox.paypal.com/';


    public function crearOrden($payload = null)
    {
        $auth = $this->oAuth2Token();

        $response = $this->request('POST', 'v2/checkout/orders', [
            'headers' => [
                'Authorization' => 'Bearer ' . $auth['access_token']
            ],
            'json' => $payload
        ]);

        return $this->decodificateResponse($response);
    }


    private function oAuth2Token()
    {
        try {
            $response = $this->request('POST', 'v1/oauth2/token', [
                'headers' => [
                    'Authorization' => 'Basic ' . base64_encode(env('PAYPAL_CLIENTE_KEY') . ':' . env('PAYPAL_CLIENTE_SECRET')),
                    'Content-Type' => 'application/x-www-form-urlencoded',
                ],
                'form_params' => [
                    'grant_type' => 'client_credentials',
                ],
            ]);


            return $this->decodificateResponse($response);
        } catch (Exception $e) {
            Log::error(print_r($e, true));
            return $e;
        }
    }

    private function decodificateResponse($data)
    {
        return json_decode((string) $data->getBody(), true);
    }
}
