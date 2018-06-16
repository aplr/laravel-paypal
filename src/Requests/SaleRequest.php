<?php

namespace Aplr\LaravelPaypal\Requests;

use Aplr\LaravelPaypal\Request;
use Aplr\LaravelPaypal\Transaction;

use PayPal\v1\Payments\PaymentCreateRequest;

class SaleRequest extends Request {

    private $cancelUrl;
    private $returnUrl;
    private $transaction;

    public function __construct(Transaction $transaction, string $cancelUrl, string $returnUrl)
    {
        $this->cancelUrl = $cancelUrl;
        $this->returnUrl = $returnUrl;
        $this->transaction = $transaction;
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
            'redirect_urls' => [
                'cancel_url' => $this->cancel_url,
                'return_url' => $this->return_url
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

}