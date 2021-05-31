<?php

namespace App\Services\Notification;
use App\Services\Notification\Providers\Contracts\Provider;

/**
 * @method sendSms(\App\Models\User $user,Stirng $message)
 * @method sendEmail(App\User $user,Mailable $message)
 */
class Notification
{
    public function __call($name, $arguments)
    {
        //  $provider = substr($name,4);
        $provider = __NAMESPACE__.'\Providers\\'.substr($name,4).'Provider';

        if(!class_exists($provider)) throw new \Exception('Provider not found');
        
        $provider = new $provider(... $arguments);
        if(!is_subclass_of($provider , Provider::class)) throw new \Exception("notification must implements Provider");
        $provider->send(); 
        
    }

}
