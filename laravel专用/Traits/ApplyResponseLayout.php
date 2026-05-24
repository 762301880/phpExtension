<?php

namespace App\Traits;

use App\Enums\BusinessCodeEnum;
use App\Enums\HttpCodeEnum;

trait ApplyResponseLayout
{
    /**
     * 成功响应
     * @param string $msg 提示信息
     * @param array $data 返回数据
     * @param int $httpCode HTTP 状态码
     * @return \Illuminate\Http\JsonResponse
     */
    protected function success($msg = '操作成功', $data = [], $httpCode = HttpCodeEnum::SUCCESS)
    {
        return response()->json([
            'code' => BusinessCodeEnum::SUCCESS,       // 业务码：0 = 成功
            'msg' => $msg,
            'data' => $data
        ], $httpCode);
    }

    /**
     * 错误响应
     * @param string $msg 错误信息
     * @param int $businessCode 业务错误码
     * @param int $httpCode HTTP 状态码
     * @return \Illuminate\Http\JsonResponse
     */
    protected function error($msg = '操作失败', $businessCode = BusinessCodeEnum::BAD_REQUEST, $httpCode = HttpCodeEnum::BAD_REQUEST)
    {
        return response()->json([
            'code' => $businessCode, // 业务错误码（前端判断用）
            'msg' => $msg,
            'data' => null
        ], $httpCode);
    }
}