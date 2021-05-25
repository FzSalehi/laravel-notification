<?php

namespace App\Services\Notification;

use App\Models\User;
use App\Services\Sms\Sms;
use Illuminate\Contracts\Mail\Mailable;
use Illuminate\Support\Facades\Mail;

class Notification
{
    public function sendEmail(User $user, Mailable $mailable)
    {
        return Mail::to($user)->send($mailable);
    }
    public function sendSms($number, $message)
    { 
        $sms = resolve(Sms::class);
        $res = $sms->send($number, $message);
        if (!$res) dd($sms->getResponse());
    }
}
