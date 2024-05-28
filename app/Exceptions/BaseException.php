<?php

namespace App\Exceptions;

use Exception;

class BaseException extends Exception
{
    protected $error;
    protected $httpCode = 500;

    public function getError()
    {
        return $this->error;
    }

    public function getHttpCode()
    {
        $this->httpCode;
    }
}
