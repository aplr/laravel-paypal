<?php

namespace Aplr\LaravelPaypal;

use Illuminate\Contracts\Support\Arrayable;

class Transaction implements Arrayable {

    private $amount;
    private $currency;

    public function __construct(float $amount, string $currency)
    {
        $this->amount = $amount;
        $this->currency = $currency;
    }

    public function toArray()
    {
        return [
            'amount' => number_format($this->amount, 2),
            'currency' => $this->currency
        ];
    }

}