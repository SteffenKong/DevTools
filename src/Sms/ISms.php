<?php

namespace SteffenTools\Sms;

/**
 * Interface ISms
 * @package SteffenTools\Sms
 */
interface ISms {

    /**
     * @param $phoneNumber
     * @param $code
     * @return mixed
     * 发送验证码
     */
    public function send($phoneNumber,$code);
}