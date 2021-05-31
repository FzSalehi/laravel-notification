<?php

namespace App\Services\Notification\Providers;

use App\Models\User;
use GuzzleHttp\Client;
use App\Services\Sms\Sms;
use App\Services\Notification\Providers\Contracts\Provider;
class SmsProvider implements Provider
{
    private $number;
    private $message;

    public function __construct(User $user, string $message)
    {
        $this->number = $user->phone_number;
        $this->message = $message;
    }

    public function send()
    {
        $sms = resolve(Sms::class);
        /* $res = $sms->send($this->number, $this->message);
        if (!$res) dd($sms->getResponse());
        return $res; 
        */
        $client = new Client();
        $client->setDefaultOption('headers', [
            'base_url' => config('services.sms.url'),
            'Authorization' => 'basic apikey:' . config('services.sms.api'),
            'Content-Type' => 'application/json',
        ]);
        
        $client->request('post', 'Message/SendSms', [
            'SmsBody' => 'text',
            'mobiles' => '091860453460',
            'SmsNumber' => '',
        ]);
        dd($client);
    }
}
