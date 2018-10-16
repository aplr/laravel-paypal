<?php

namespace Aplr\LaravelPaypal;

use Illuminate\Contracts\Support\Arrayable;

class Transaction implements Arrayable {

    private $amount;

    private $items;
    private $address;
    private $orderNumber;

    public function __construct(string $orderNumber, Amount $amount, array $items = [], ?Address $address = null)
    {
        $this->items = $items;
        $this->amount = $amount;
        $this->address = $address;
        $this->orderNumber = $orderNumber;
    }

    public function toArray()
    {
        return [
            'amount' => $this->amount,
            'invoice_number' => $this->orderNumber,
            'item_list' => $this->buildItemList(),
        ];
    }

    private function buildItemList()
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