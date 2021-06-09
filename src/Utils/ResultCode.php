<?php
namespace SteffenTools\Utils;

/**
 * Class ResultCode
 * @package SteffenTools\Utils
 * 系统级别响应码
 */
class ResultCode
{
    //------------系统级别-------------------
    //成功
    const SUCCESS = ['code' => '000', 'message' => '操作成功'];

    //错误
    const ERROR = ['code' => '001', 'message' => '操作失败'];
    //------------系统级别-------------------
}