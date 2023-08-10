<?php


namespace App\Services;


use Illuminate\Support\Facades\Redis;

class RedisService
{
    private static $instance = null;

    private function __construct()
    {
        // 私有化构造函数以避免类被实例化，只能通过 getInstance 方法获得类的唯一实例。
    }

    public static function getInstance()
    {
        if (is_null(self::$instance)) {
            self::$instance = Redis::connection()->client();
        }
        return self::$instance;
    }

    public function __call($method, $arguments)
    {
        return call_user_func_array([self::getInstance(), $method], $arguments);
    }
}


