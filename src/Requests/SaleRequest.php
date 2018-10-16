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
        $this->transaction = $transaction;
        $this->cancelUrl = $cancelUrl;
        $this->returnUrl = $returnUrl;
    }

    protected function createRequest()
    {
        return new PaymentCreateRequest();
    }

    protected function getBody()
    {
        return [
            'intent' => 'sale',
            'payer' => [
                'payment_method' => 'paypal'
            ],
            'transactions' => $this->getTransactions(),
            'redirect_urls' => [
                'cancel_url' => $this->cancelUrl,
                'return_url' => $this->returnUrl
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