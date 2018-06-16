<?php

namespace Aplr\LaravelPaypal\Requests;

use Aplr\LaravelPaypal\Request;

use PayPal\v1\Payments\PaymentExecuteRequest;

class ExecuteRequest extends Request {

    private $execution;

    public function __construct(Execution $execution)
    {
        $this->execution = $execution;
    }

    protected function createRequest()
    {
        return new PaymentExecuteRequest(
            $this->execution->getPaymentId()
        );
    }

    protected function getBody()
    {
        return [
            'payer_id' => $this->execution->getPayerId(),
            'transactions' => $this->getTransactions()
        ];
    }

    private function getTransactions()
    {
        return [
            $this->execution->getTransaction()->toArray()
        ];
    }

}