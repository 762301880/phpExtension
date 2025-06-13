<?php


namespace app\common\dao;


use app\business\model\Area;
use app\common\dao\abs\BaseDao;

class AreaDao extends BaseDao
{


    public static function getPathIdById($id)
    {
        $area = self::findById($id);
        if (empty($area)) return "";
        return $area->path_id;
    }

    public static function model(): string
    {
       return Area::class;
    }
}