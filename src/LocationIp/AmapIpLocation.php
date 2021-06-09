<?php
namespace SteffenTools\LocationIp;

use SteffenTools\Core\Loader;
use SteffenTools\String\StringUtils;
use SteffenTools\Utils\ApiCurl;

/**
 * Class AmapIpLocation
 * @package SteffenTools\LocationIp
 * 高德IP定位服务
 */
class AmapIpLocation
{

    private $appKey;

    private $url;

    public function __construct()
    {
        $this->url = 'https://restapi.amap.com/v3/ip';
    }


    /**
     * @param $appKey
     * @return mixed
     * 设置AppKey
     */
    public function setAppKey($appKey)
    {
        return $this->appKey = $appKey;
    }


    /**
     * @param $ip
     * @return false|mixed|string
     * ip定位操作
     */
    public function locationIp($ip)
    {
        list($bool,$type) = $this->checkIp($ip);

        if(!$bool) return $type;

        $params = [
            'key' => $this->appKey,
            'ip' => $ip,                //需要搜索的IP地址（仅支持国内）
            'output' => 'JSON'          //返回格式
        ];
        /* @var ApiCurl $apiCurl */
        $apiCurl = Loader::singleton(ApiCurl::class);
        // 构造请求的url
        $this->url = $this->url . '?' .http_build_query($params);
        $result = $apiCurl->get($this->url);
        if (!$result) return false;
        $responseData = StringUtils::jsonDecode($result,true);
        if ((isset($responseData['status']) && $responseData['status'] == 1)
            && (isset($responseData['info']) && $responseData['info'] === 'OK'))
        {
            return "{$responseData['province']} {$responseData['city']}";
        }
        return false;
    }


    /**
     * @param $ip
     * @return array
     * 检测IP是否符合请求定位接口的标准，如果是内网或者本地的IP无需请求接口
     */
    public function checkIp($ip)
    {
        if (strpos($ip,'127.') !== false)
        {
            return [false,'本地'];
        }
        $check = filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE);
        if (!$check)
        {
            return [false,'内网'];
        }
        return [true,'公网'];
    }
}