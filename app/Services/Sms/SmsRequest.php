<?php

namespace App\Services\Sms;

class SmsRequest
{

    public $SmsBody;
    public $Mobiles;
    public $SmsNumber;
    public function __construct($numbers, $message)
    {
        $this->SmsBody = $message;
        $this->Mobiles = $numbers;
        $this->SmsNumber = '';
    }
}
