<?php

namespace Aplr\LaravelPaypal;

use Illuminate\Contracts\Support\Arrayable;

class Amount implements Arrayable {

    private $value;
    private $currency;

    public function __construct(float $value, string $currency)
    {
        $this->value = $value;
        $this->currency = $currency;
    }

    public function toArray()
    {
        return [
            'total' => number_format($this->value, 2),
            'currency' => $this->currency
        ];
    }

}