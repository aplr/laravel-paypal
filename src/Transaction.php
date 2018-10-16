<?php

namespace Aplr\LaravelPaypal;

use Illuminate\Contracts\Support\Arrayable;

class Transaction implements Arrayable {

    private $amount;
    private $currency;
    private $orderNumber;

    public function __construct(string $orderNumber, float $amount, string $currency)
    {
        $this->amount = $amount;
        $this->currency = $currency;
        $this->orderNumber = $orderNumber;
    }

    public function toArray()
    {
        return [
            'amount' => [
                'total' => number_format($this->amount, 2),
                'currency' => $this->currency
            ]
        ];
    }

    public function getOrderNumber()
    {
        return $this->orderNumber;
    }

}