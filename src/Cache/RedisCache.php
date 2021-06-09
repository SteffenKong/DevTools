<?php
namespace SteffenTools\Cache;

use Predis\Client;

/**
 * Class RedisCache
 * @package SteffenTools\Cache
 * Redis工具（限制连接一次）
 */
class RedisCache
{

    public static $redisClient = null;

    /**
     * @var
     * redis主机
     */
    private $host;

    /**
     * @var
     * tcp
     */
    private $scheme;

    /**
     * @var
     * redis密码
     */
    private $password;


    /**
     * @var
     * redis端口
     */
    private $port;


    /**
     * @param $config
     * @return $this
     * 设置配置
     */
    public function setConfig($config)
    {
        $this->host = isset($config['host']) ? $config['host']:'127.0.0.1';
        $this->scheme = isset($config['scheme']) ? $config['scheme']:'tcp';
        $this->password = isset($config['password']) ? $config['password']:'';
        $this->port = isset($config['port']) ? $config['port']: 6379;
        return $this;
    }


    /**
     * @return Client|null
     */
    public function connection()
    {
        if (empty(self::$redisClient))
        {
            self::$redisClient = new Client([
                'host' => $this->host,
                'scheme' => $this->scheme,
                'password' => $this->password,
                'port' => $this->port,
            ]);
        }
        return self::$redisClient;
    }


    /**
     * @param $method
     * @param $args
     * @return
     * 代理模式，代理调用predis client中的方法
     */
    public function __call($method,$args)
    {
        return $this->connection()->$method(...$args);
    }
}