<?php

namespace Aplr\LaravelPaypal;

use Illuminate\Contracts\Support\Arrayable;

class Transaction implements Arrayable {

    private $amount;
    private $currency;

    private $items;
    private $address;
    private $orderNumber;

    public function __construct(string $orderNumber, float $amount, string $currency, array $items = [], ?Address $address = null)
    {
        $this->amount = $amount;
        $this->currency = $currency;

        $this->items = $items;
        $this->address = $address;
        $this->orderNumber = $orderNumber;
    }

    public function toArray()
    {
        return [
            'amount' => [
                'total' => number_format($this->amount, 2),
                'currency' => $this->currency
            ],
            'invoice_number' => $this->orderNumber,
            'item_list' => $this->getItemList(),
        ];
    }

    private function getItemList()
    {
        $itemList = [];

        if (!is_null($this->address)) {
            $itemList['shipping_address'] = $this->address;
        }
        
        if (!empty($this->items)) {
            $itemList['items'] = $this->items;
        }

        return $itemList;
    }

}