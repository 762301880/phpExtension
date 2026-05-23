<?php

namespace App\Traits;

use Hyperf\HttpServer\Contract\ResponseInterface as HttpResponse;
use Psr\Container\ContainerInterface;


trait ApiResponseTrait
{


    protected HttpResponse $response;

    public function __construct(HttpResponse $response)
    {
        $this->response = $response;
    }

    /**
     * 成功返回
     */
    protected function success(string $msg = 'success', array $data = [], int $code = 0)
    {
        //https://hyperf.wiki/3.1/#/zh-cn/response  响应文档
        return $this->response->json([
            'code' => $code,
            'msg' => $msg,
            'data' => $data,
        ]);
    }

    protected function error(string $msg = 'error', int $code = 1000)
    {
        return $this->response->json([
            'code' => $code,
            'msg' => $msg,
            'data' => null
        ]);
    }
}