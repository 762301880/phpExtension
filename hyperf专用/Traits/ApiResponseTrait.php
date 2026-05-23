<?php
namespace App\Traits;

trait ApiResponseTrait
{
    /**
     * 成功返回
     */
    protected function success(string $msg = 'success', array $data = [], int $code = 200)
    {
        return [
            'code' => $code,
            'msg'  => $msg,
            'data' => $data,
        ];
    }

    protected function error(string $msg = 'error', array $data = [], int $code = 500)
    {
        return [
            'code' => $code,
            'msg'  => $msg,
            'data' => $data,
        ];
    }
}