<?php

namespace Aplr\LaravelPaypal\Requests;

use Aplr\LaravelPaypal\Request;
use Aplr\LaravelPaypal\Transaction;

use PayPal\v1\Payments\PaymentCreateRequest;

class SaleRequest extends Request {

    private $cancelUrl;
    private $returnUrl;
    private $transaction;
    private $address;
    private $items;

    public function __construct(Transaction $transaction, ?Address $address, array $items, string $cancelUrl, string $returnUrl)
    {
        $this->cancelUrl = $cancelUrl;
        $this->returnUrl = $returnUrl;
        $this->transaction = $transaction;
        $this->address = null;
        $this->items = [];
    }

    protected function createRequest()
    {
        return new PaymentCreateRequest();
    }

    protected function getBody()
    {
        return [
            'intent' => 'sale',
            'transactions' => $this->getTransactions(),
            'item_list' => $this->getItemList(),
            'invoice_number' => $this->transaction->getOrderNumber(),
            'redirect_urls' => [
                'cancel_url' => $this->cancelUrl,
                'return_url' => $this->returnUrl
            ],
            'payer' => [
                'payment_method' => 'paypal'
            ]
        ];
    }

    private function getTransactions()
    {
        return [
            $this->transaction->toArray()
        ];
    }

    private function getItemList()
    {
        $itemList = [];

        if (!is_null($this->address)) {
            $itemList['shipping_address'] = $this->address->toArray();
        }
        
        if (!empty($this->items)) {
            $itemList['items'] = collect($this->items)->map(function ($item) {
                return $item->toArray();
            });
        }

        return $itemList;
    }

}