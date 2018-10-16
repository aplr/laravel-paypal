<?php

namespace Aplr\LaravelPaypal;

class Execution {

    private $paymentId;
    private $payerId;

    public function __construct(string $paymentId, string $payerId)
    {
        $this->paymentId = $paymentId;
        $this->payerId = $payerId;
    }

    public function getPaymentId()
    {
        return $this->paymentId;
    }

    public function getPayerId()
    {
        return $this->payerId;
    }

}