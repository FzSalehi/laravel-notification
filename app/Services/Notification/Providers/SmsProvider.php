<?php

namespace App\Services\Notification\Providers;

use App\Services\Notification\Providers\Contracts\Provider;
use App\Services\Sms\Sms;

class SmsProvider implements Provider
{
    private $numbers;
    private $message;

    public function __construct($numbers,string $message)
    {
        $this->numbers = $numbers;
        $this->message = $message;
    }

    public function send()
    {
        $sms = resolve(Sms::class);
        $res = $sms->send($this->numbers, $this->message);
        if (!$res) dd($sms->getResponse());
        return $res;
    }
}