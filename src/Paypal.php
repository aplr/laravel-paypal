<?php 

namespace Aplr\LaravelPaypal;

use Aplr\LaravelPaypal\Exceptions\InvalidEnvironmentException;

use PayPal\Core\PayPalHttpClient;
use PayPal\Core\SandboxEnvironment;
use PayPal\Core\ProductionEnvironment;

use BraintreeHttp\HttpException;
use BraintreeHttp\HttpResponse;

use Aplr\LaravelPaypal\Requests\SaleRequest;
use Aplr\LaravelPaypal\Requests\ExecuteRequest;

class Paypal {
    
    private $config;
    private $environment;

    public function __construct(array $config)
    {
        $this->config = $config;
        $this->environment = $this->createEnvironment($config);
        $this->client = new PayPalHttpClient($this->environment);
    }

    private function createEnvironment(array $config)
    {
        if ($config['environment'] == 'sandbox') {
            return new SandboxEnvironment($config['client_id'], $config['client_secret']);
        } else if ($config['environment'] == 'production') {
            return new ProductionEnvironment($config['client_id'], $config['client_secret']);
        }

        throw new InvalidEnvironmentException();
    }

    public function sale(Transaction $transaction)
    {
        return $this->request(new SaleRequest(
            $transaction,
            $this->config['cancel_url'],
            $this->config['return_url']
        ));
    }

    public function execute(Execution $payment)
    {
        return $this->request(new ExecuteRequest(
            $execution
        ));
    }

    private function request(Request $request)
    {
        return $request->request($this->client);
    }
    
}