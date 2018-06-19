<?php

namespace Aplr\LaravelPaypal\Requests;

use Aplr\LaravelPaypal\Request;

use PayPal\v1\Payments\PaymentGetRequest;

class GetRequest extends Request {

    public function __construct(string $id)
    {
        $this->id = $id;
    }

    protected function createRequest()
    {
        return new PaymentGetRequest($this->id);
    }

    protected function getBody()
    {
        return null;
    }

}