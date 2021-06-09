<?php
namespace SteffenTools\String;

/**
 * Class Str
 * @package SteffenTools\String
 */
class Str
{

    /**
     * @param string $str
     * @return bool
     * 判断字符串是否为空
     */
    public function isEmpty(string $str)
    {
        return empty($str);
    }
}