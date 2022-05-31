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

    /**
     * 返回所有的字段名称
     * 缺点必须有一条记录才可以 需要排除的字段
     * @param array $exceptField 需要排除的字段
     * @return array
     */
    public static function getFieldNames($exceptField = [])
    {
        $selfModel = self::field($exceptField, true)->find()->toArray();
        return empty($selfModel) ? [] : array_keys($selfModel);
    }
}