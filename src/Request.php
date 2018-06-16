<?php

namespace Aplr\LaravelPaypal;

use PayPal\Core\PayPalHttpClient;

use BraintreeHttp\HttpResponse;

abstract class Request {

    protected abstract function createRequest();

    protected abstract function getBody();

    public function request(PayPalHttpClient $client)
    {
        $request = $this->createRequest();

        $request->body = $this->getBody();

        try {
            return $this->handleResponse($client->execute($request));
        } catch (HttpException $e) {
            $this->handleException($e);
        }
    }

    protected function handleResponse(HttpResponse $response)
    {
        return $response;
    }

    protected function handleException(HttpException $e)
    {
        throw $e;
    }

}