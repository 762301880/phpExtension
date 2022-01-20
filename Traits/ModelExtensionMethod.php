<?php


namespace App\Traits;


use Illuminate\Support\Facades\Schema;

trait ModelExtensionMethod
{
    /**
     * 返回Model模型对应数据表名称
     * 使用 例如  User::getTableName()  返回 模型中定义的 protected $table = 'stu'; 表名称
     */
    public function getTableName()
    {
        return self::getModel()->getTable();
    }

    /**
     * 返回数据表的所有字段  使用  User::getColumnListing();
     * @return array
     */
    public function getColumnListing()
    {
        return Schema::getColumnListing(self::getTableName());
    }

    /**
     * 选择数据库中不想要的字段的所有字段  使用示例(除却id之外的所有)User::exceptSelect(['id'])->get()->toArray()
     * @param array $columns
     * @return mixed
     */
    public function exceptSelect($columns = [])
    {
        $columns = is_array($columns) ? $columns : (array)$columns;
        $modelColumns = self::getColumnListing();
        return self::select(array_diff($modelColumns, $columns));
    }
}