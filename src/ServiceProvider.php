<?php 

namespace Aplr\LaravelPaypal;

use Illuminate\Support\ServiceProvider as LaravelServiceProvider;

class ServiceProvider extends LaravelServiceProvider {
    
    protected $defer = true;
    
    public function register()
    {
        $this->mergeConfigFrom($this->configPath(), 'paypal');
        
        $this->registerPaypalClient();
    }
    
    public function boot()
    {
        $this->publishes([
            $this->configPath() => config_path('paypal.php')
        ]);
    }
    
    /**
     * Registers the paypal client in laravel's service container.
     */
    protected function registerPaypalClient()
    {
        $this->app->singleton(Paypal::class, function($app) {
            return new Paypal($app['config']['paypal']);
        });
    }
    
    protected function configPath()
    {
        return __DIR__ . '/../config/paypal.php';
    }
    
    public function provides()
    {
        return [ Paypal::class ];
    }
    
}