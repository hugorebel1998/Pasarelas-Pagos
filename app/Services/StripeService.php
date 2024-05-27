<?php

namespace App\Services;

use Exception;
use Illuminate\Encryption\Encrypter;
use Illuminate\Support\Facades\Log;

class StripeService extends HttpCliente
{
    protected $baseUri = 'https://api.stripe.com/';

    public function __construct(array $config = [])
    {
        $config += [
            'headers' => [
                'Authorization' => 'Bearer ' . $this->getApiKey(),
            ]
        ];

        parent::__construct($config);
    }

    public function getApiKey()
    {
        $stripe_secret_db = confenv('STRIPE_CLIENTE_SECRET');

        return (new Encrypter(env('KEY_ENCRYPT')))->decrypt($stripe_secret_db);
    }

    public function createSesion($payload)
    {
        $response =  $this->request('POST', 'v1/checkout/sessions', [
            'form_params' => $payload
        ]);

        return $this->decodificateResponse($response);
    }

    private function decodificateResponse($data)
    {
        return json_decode($data->getBody()->getContents(), true);
    }
}
