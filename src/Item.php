<?php

namespace Aplr\LaravelPaypal;

use Illuminate\Contracts\Support\Arrayable;

class Item implements Arrayable {

    private $name;
    private $description;
    private $quantity;
    private $price;
    private $sku;

    public function __construct(string $name, string $description, string $sku, int $quantity, flaot $price)
    {
        $this->name = $name;
        $this->description = $description;
        $this->sku = $sku;
        $this->quantity = $quantity;
        $this->price = $price;
    }

    public function toArray()
    {
        return [
            'name' => $this->name,
            'description' => $this->description,
            'sku' => $this->sku,
            'quantity' => $this->quantity,
            'price' => $this->price
        ];
    }

}