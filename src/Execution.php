<?php

namespace Aplr\LaravelPaypal;

use Illuminate\Contracts\Support\Arrayable;

class Execution implements Arrayable {

    private $paymentId;
    private $payerId;
    private $transaction;

    public function __construct(string $paymentId, string $payerId, Transaction $transaction)
    {
        $this->paymentId = $paymentId;
        $this->payerId = $payerId;
        $this->transaction = $transaction;
    }

    public function getPaymentId()
    {
        return $this->paymentId;
    }

    public function getPayerId()
    {
        return $this->payerId;
    }

    public function getTransaction()
    {
        return $this->transaction;
    }

}