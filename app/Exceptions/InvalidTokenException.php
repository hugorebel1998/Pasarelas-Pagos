<?php

namespace App\Exceptions;


class InvalidTokenException extends BaseException
{

    public function __construct($error, $httpCode = 500, $message = 'Error autenticación', $previous = null)
    {

        $this->error = $error;
        $this->httpCode = $httpCode;

        parent::__construct($message, $httpCode, $previous);
    }

    public function render()
    {
        return response()->json([
            'message' => $this->message,
            'error' => $this->error,
        ], $this->httpCode);
    }
}
