<?php
namespace SteffenTools\Core;

/**
 * Class Loader
 * @package SteffenTools\Core
 */
class Loader
{


    // 存储实例化对象
    public static $classList = [];


    /**
     * @param $className
     * @return mixed
     * 单例
     */
    public static function singleton($className)
    {
        if (isset(self::$classList[$className]))
        {
            return self::$classList[$className];
        }
        return self::$classList[$className] = new $className;
    }


    /**
     * @param $serviceName
     * @return mixed
     * 实例化服务层
     */
    public static function service($serviceName)
    {
        return self::singleton($serviceName);
    }


    /**
     * @param $daoName
     * @return mixed
     * 实例化dao层
     */
    public static function dao($daoName)
    {
        return self::singleton($daoName);
    }
}