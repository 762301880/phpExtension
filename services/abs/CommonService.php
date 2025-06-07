<?php


namespace App\Services\Abs;


abstract class CommonService
{
    private static $instances = []; //必须将静态属性初始化为数组 []，才能当作数组来使用。否则它默认是 null，不能当成数组操作，就会出错。

    /**
     * service继承后 不必实例化方法可直接调用
     * 示例
     * $service = Order::getInstance()->getTotalMoney(); //直接调用
     * @return mixed|static
     */
    public static function getInstance()
    {
        $class = static::class;
        //https://www.cainiaoplus.com/php/php-function-get-called-class.html
        #$class = get_called_class(); // 获取调用类名
        if (!isset(self::$instances[$class])) {
            self::$instances[$class] = new static();
        }
        return self::$instances[$class];
    }
}