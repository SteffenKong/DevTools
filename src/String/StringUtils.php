<?php
namespace SteffenTools\String;

/**
 * Class StringUtils
 * @package SteffenTools\String
 * 字符串处理工具
 */
class StringUtils
{

    /**
     * @param array $data
     * @return false|string
     */
    public static function jsonEncode(array $data)
    {
        return \json_encode($data,JSON_UNESCAPED_UNICODE);
    }


    /**
     * @param string $data
     * @param false $toArray
     * @return mixed
     */
    public static function jsonDecode(string $data,$toArray = false)
    {
        return \json_decode($data,$toArray);
    }
}