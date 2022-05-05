<?php


namespace app\Traits;


trait ModelExtensionMethod
{
    /**
     * 修改或更新
     * @param array $attributes
     * @return ModelExtensionMethod
     */
    public static function updateOrCreate(array $attributes = [])
    {
        if (!is_null($instance = self::where($attributes)->find())) {
            return $instance;
        }
        return new self();
    }
}