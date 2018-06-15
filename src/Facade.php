<?php 

namespace Aplr\LaravelPaypal;

use Illuminate\Support\Facades\Facade as BaseFacade;

class Facade extends BaseFacade {
    
    /**
     * Get the registered component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return Paypal::class;
    }
    
}