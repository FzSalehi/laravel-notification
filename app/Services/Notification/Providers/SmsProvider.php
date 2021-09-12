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
        $client = new Client();

        $response = $client->post('https://sms.parsgreen.ir/Apiv2/Message/SendSms', $this->smsOptions());

        return $response->getStatusCode() == 200;

    }

    private function smsOptions()
    {
        $body = [
            'SmsBody' => $this->message,
            'Mobiles' => [$this->number],
            'SmsNumber' => 'nisi',
        ];

        return [
            'headers' => [
                'Host' => 'sms.parsgreen.ir',
                'Authorization' => 'basic apikey:'.env('SMS_API'),
                'Content-Type' => 'application/json',
            ],
            'json' => $body
        ];
    }
}
