<?php

namespace App\Services;

use GuzzleHttp\Client;
use Psr\Http\Message\ResponseInterface;

class HttpCliente extends Client
{

    protected $baseUri;

    public function __construct(array $config = [])
    {

        $config += [
            'base_uri' => $this->getBaseUri(),
            'verify'   => !env('APP_ENV')
        ];

        parent::__construct($config);
    }

    public function getBaseUri(): ?string
    {
        return $this->baseUri;
    }


    public function request(string $method, $uri = '', array $options = []): ResponseInterface
    {

        return parent::request($method, $uri, $options);

    }
}
