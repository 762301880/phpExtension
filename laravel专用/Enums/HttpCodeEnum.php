<?php
namespace App\Enums;
class HttpCodeEnum
{
    const SUCCESS = 200;
    const BAD_REQUEST = 400;
    const UNAUTHORIZED = 401;
    const FORBIDDEN = 403;
    const NOT_FOUND = 404;
    const SERVER_ERROR = 500;


    public static function message(int $code): string
    {
        $map = [
            self::SUCCESS => '请求成功',
            self::BAD_REQUEST => '请求参数错误',
            self::UNAUTHORIZED => '未授权',
            self::FORBIDDEN => '禁止访问',
            self::NOT_FOUND => '资源未找到',
            self::SERVER_ERROR => '服务器错误',
        ];

        return $map[$code] ?? '未知错误';
    }


}