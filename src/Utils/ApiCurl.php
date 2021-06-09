<?php
namespace SteffenTools\Utils;


/**
 * Class ApiCurl
 * @package SteffenTools\Utils
 * 模拟http请求工具
 */
class ApiCurl
{

    public $ch;

    public function __construct()
    {
        $this->ch = curl_init();
    }


    /**
     * @param $url
     * @return false|string
     */
    public function get($url)
    {
        curl_setopt($this->ch,CURLOPT_URL,$url);
        curl_setopt($this->ch,CURLOPT_RETURNTRANSFER,1);
        curl_setopt($this->ch,CURLOPT_SSL_VERIFYPEER,false);
        curl_setopt($this->ch,CURLOPT_SSL_VERIFYHOST,false);
        curl_setopt($this->ch,CURLOPT_HEADER,false);
        return curl_exec($this->ch);
    }
}