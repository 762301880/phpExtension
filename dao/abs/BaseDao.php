<?php

namespace app\common\dao\abs;

use think\Model;

abstract class BaseDao
{
    /**
     * 获取模型类名称（由子类实现）
     * @return string
     */
    abstract public static function model(): string;

    /**
     * 获取模型实例
     * @return Model
     */
//    protected static function getModel(): Model
//    {
//        static $model = null;
//        if (!$model) {
//            $modelName = static::model(); // 正确调用静态方法
//            $modelInstance = new $modelName();
//            if (!$modelInstance instanceof Model) {
//                throw new \RuntimeException("Model must be an instance of think\\Model");
//            }
//            $model = $modelInstance;
//        }
//        return $model;
//    }

    protected static function getModel(): Model
    {
        static $models = [];
        $modelName = static::model();
        if (!isset($models[$modelName])) {
            $modelInstance = new $modelName();
            if (!$modelInstance instanceof Model) {
                throw new \RuntimeException("Model must be an instance of think\\Model");
            }
            $models[$modelName] = $modelInstance;
        }
        return $models[$modelName];
    }

    /**
     * 通用根据ID查询方法
     * @param mixed $id
     * @return Model|array|object|null
     */
    public static function findById($id)
    {
        return self::getModel()::where('id', $id)->find() ?? null;
    }
}
