<?php

namespace App\Services\Notification\Constants;

use App\Mail\TopicCreated;
use App\Mail\UserRegisterd;
use App\Mail\ForgetPassword;


class EmailTypes
{
    const USER_REGISTERED = 1;
    const TOPIC_CREATED = 2;
    const FORGET_PASSWORD = 3;

    public static function toFarsi()
    {
        return [
            self::USER_REGISTERED => 'ثبت نام کاربران',
            self::TOPIC_CREATED => 'ایجاد مقاله جدید',
            self::FORGET_PASSWORD => 'فراموشی رمز عبور'
        ];
    }

    public static function getMailClass(int $id)
    {
        try {
            return [
                self::USER_REGISTERED => UserRegisterd::class,
                self::TOPIC_CREATED => TopicCreated::class,
                self::FORGET_PASSWORD => ForgetPassword::class,
            ][$id];
        } catch (\Throwable $e) {
            throw new \InvalidArgumentException('Mailable class dose not exists');
        }
    }
}
