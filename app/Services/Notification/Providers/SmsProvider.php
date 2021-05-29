<?php

namespace App\Services\Notification\Providers;

use App\Models\User;
use App\Services\Notification\Providers\Contracts\Provider;
use App\Services\Sms\Sms;

class SmsProvider implements Provider
{
    private $number;
    private $message;

    public function __construct(User $user,string $message)
    {
        $this->number = $user->phone_number;
        $this->message = $message;
    }

    public function send()
    {
        $sms = resolve(Sms::class);
        $res = $sms->send($this->number, $this->message);
        if (!$res) dd($sms->getResponse());
        return $res;
    }
}