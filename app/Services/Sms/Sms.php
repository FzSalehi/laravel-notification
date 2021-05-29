<?php

namespace App\Services\Sms;


class Sms
{
    private $url;

    private $apikey;

    private $response;

    function  __construct()
    {
        $this->url = config('services.sms.url');
        $this->apikey = config('services.sms.api');
    }


    private function exec($urlpath, $req)
    {
        try {
            $this->url =  $this->url . '/Apiv2/' . $urlpath;
            $ch = curl_init($this->url);
            $jsonDataEncoded = json_encode($req);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonDataEncoded);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
            $header = array('authorization: BASIC APIKEY:' . $this->apikey, 'Content-Type: application/json;charset=utf-8');
            curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
            $response = curl_exec($ch);
            $this->response = json_decode($response);
            curl_close($ch);
        } catch (\Exception $ex) {
            dd($ex);
        }
    }

    public function send($numbers, $message)
    {
        $this->exec("Message/SendSms", new SmsRequest($numbers, $message));
        $this->getResponse();
    }

    public function getResponse()
    {
        return $this->response;
    }

    public function getErrorMessage()
    {
        return $this->getresponse()->R_Message;
    }

    public function getErrorCode()
    {
        return $this->response->R_Code;
    }

    public function isSuccsesful()
    {
        return $this->response->R_Success;
    }

    public function getData()
    {
        return $this->response->DataList;
    }

    public function getSuccessCount()
    {
        return $this->response->SuccessCount;
    }
}
