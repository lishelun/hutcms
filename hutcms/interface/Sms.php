<?php
/*
 *  +----------------------------------------------------------------------
 *  | HUTCMS
 *  +----------------------------------------------------------------------
 *  | Copyright (c) 2022 http://hutcms.com All rights reserved.
 *  +----------------------------------------------------------------------
 *  | Licensed ( https://mit-license.org )
 *  +----------------------------------------------------------------------
 *  | Author: lishelun <lishelun@qq.com>
 *  +----------------------------------------------------------------------
 */

namespace hutcms\interface;
interface Sms
{

    /**
     * 发送短信
     * 主要适用于短信单发场景，特殊场景下可支持群发（最多可向1000个手机号码发送同样内容的短信），但群发会有一定延迟
     *
     * @param string      $phoneNumbers    接收短信的手机号码
     *                                     支持对多个手机号码发送短信，手机号码之间以半角逗号（,）分隔。上限为1000个手机号码。批量调用相对于单条调用及时性稍有延迟。
     * @param string      $signName        短信签名名称
     * @param string      $templateCode    短信模板CODE
     * @param array       $templateParam   短信模板变量对应的实际值
     * @param string|null $outId           外部流水扩展字段
     * @param string|null $smsUpExtendCode 上行短信扩展码
     *
     * @return bool
     */
    public function sendSms(string $phoneNumbers , string $signName , string $templateCode , array $templateParam , string $outId = null , string $smsUpExtendCode = null): bool;

    /**
     * 群发短信
     * 短信批量发送接口，支持在一次请求中分别向多个不同的手机号码发送不同签名的短信。
     *
     * @param array       $phoneNumbers    接收短信的手机号码
     * @param array       $signName        短信签名名称
     * @param string      $templateCode    短信模板CODE
     * @param array       $templateParam   短信模板变量对应的实际值
     * @param string|null $smsUpExtendCode 上行短信扩展码
     *
     * @return bool
     */
    public function sendBatchSms(array $phoneNumbers , array $signName , string $templateCode , array $templateParam , string $smsUpExtendCode = null): bool;

    /**
     * 发送验证码
     * @param string $phoneNumber 接收短信的手机号码
     * @param string $code 验证码
     *
     * @return bool
     */
    public function sendCode(string $phoneNumber , string $code): bool;

    /**
     * 发送消息
     * @param string $phoneNumber 接收短信的是手机号码
     * @param string $message 消息内容
     *
     * @return bool
     */
    public function sendMessage(string $phoneNumber , string $message): bool;
}