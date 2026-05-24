<?php
namespace App\Enums;

class BusinessCodeEnum
{
    const SUCCESS = 0;
    const BAD_REQUEST = 1000;

    public static function message(int $code): string
    {
        $map = [
            self::SUCCESS => '操作成功',
            self::BAD_REQUEST => '操作失败',
        ];

        return $map[$code] ?? '未知错误';
    }
}
