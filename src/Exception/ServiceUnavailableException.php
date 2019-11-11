<?php

namespace MaxMind\MinFraudChargeback\Exception;

class ServiceUnavailableException extends ExceptionAbstract
{
    public function __construct()
    {
        parent::__construct('There was a problem with the service. Try again.');
    }
}
