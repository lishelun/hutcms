<?php

declare (strict_types = 1);

namespace hutcms\plugin\sms;
use hutcms\interface\Sms;
use hutphp\extend\Curl;
class AliyunSms implements Sms
{
    protected string $access_key_id;
    protected string $access_secret;
    public function sendSms(string $phoneNumbers , string $signName , string $templateCode , array $templateParam , string $outId = null , string $smsUpExtendCode = null): bool
    {
        // TODO: Implement sendSms() method.
        Curl::get('',[],[]);
        return true;
    }
    public function sendBatchSms(array $phoneNumbers , array $signName , string $templateCode , array $templateParam , string $smsUpExtendCode = null): bool
    {
        // TODO: Implement sendBatchSms() method.
        return true;
    }
    public function sendCode(string $phoneNumber , string $code): bool
    {
        // TODO: Implement sendCode() method.
        return true;
    }

    public function sendMessage(string $phoneNumber , string $message): bool
    {
        // TODO: Implement sendMessage() method.
        return true;
    }

    public static function create()
    {
        return app()->make(static::class,[]);
    }
    public function __construct()
    {
        $conf=include __DIR__.'config.php';
        $this->access_key_id=$conf['access_key_id'];
        $this->access_secret=$conf['access_secret'];
    }

}