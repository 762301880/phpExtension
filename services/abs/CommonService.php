<?php


namespace App\Services\Abs;


abstract class CommonService
{
    private static $instances = [];

    /**
     * service继承后 不必实例化方法可直接调用
     * 示例
     * $service = Order::getInstance()->getTotalMoney(); //直接调用
     * @return mixed|static
     */
    public static function getInstance()
    {
        $class = static::class;
        if (!isset(self::$instances[$class])) {
            self::$instances[$class] = new static();
        }
        return self::$instances[$class];
    }
}