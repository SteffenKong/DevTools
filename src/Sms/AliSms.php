<?php
 namespace SteffenTools\Sms;

 use AlibabaCloud\SDK\Dysmsapi\V20170525\Dysmsapi;

 use Darabonba\OpenApi\Models\Config;
 use AlibabaCloud\SDK\Dysmsapi\V20170525\Models\SendSmsRequest;

 /**
  * Class AliSms
  * @package SteffenTools\Sms
  * 阿里大于发送接口SDK封装
  */
 class AliSms implements ISms
 {

     private $config = [];

     private static $client = null;

     /**
      * AliSms constructor.
      * @param $config
      */
     public function __construct($config) {
         $this->setConfig($config);
        $this->createClient();
     }


     /**
      * @param $config
      * @return $this
      * 设置配置
      */
     private function setConfig($config) {
         $this->config = $config;
         return $this;
     }


     /**
      * @return array
      * 获取配置
      */
     public function getConfig() {
         return $this->config;
     }

     /**
      * 使用AK&SK初始化账号Client
      * @return void Client
      */
     private function createClient(){
         $config = new Config([
             // AccessKey ID
             "accessKeyId" => $this->getConfig()['accessKeyId'],
             // AccessKey Secret
             "accessKeySecret" => $this->getConfig()['accessKeySecret'],
         ]);
         // 访问的域名
         $config->endpoint = $this->getConfig()['domain'];
         self::$client = new Dysmsapi($config);
     }


     /**
      * @param $phoneNumber
      * @param $code
      * @return void
      * 发送
      */
     public function send($phoneNumber,$code){
         $sendSmsRequest = new SendSmsRequest([
             "phoneNumbers" => $phoneNumber,
             "signName" => $this->getConfig()['signName'],
             "templateCode" => $this->getConfig()['templateCode'],
             "templateParam" => "{\"code\":\"$code\"}"
         ]);

         self::$client->sendSms($sendSmsRequest);
     }
 }

