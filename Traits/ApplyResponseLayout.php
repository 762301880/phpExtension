<?php


namespace App\Traits;


trait ApplyResponseLayout
{

    /**
     * 成功返回
     * 这里解释一下为什么要把data数组返回放在最前面应为我们希望成功之后最常用的返回就是数据
     * @param string $successMsg
     * @param array $data
     * @param int $code
     * @return \Illuminate\Http\JsonResponse
     */
    protected function success($data = [], $successMsg = 'success', $code = 200)
    {
        return response()->json(['code' => $code, 'msg' => $successMsg, 'data' => $data]);
    }


    /**
     * 错误返回
     * @param null $errorMsg
     * @param array $data
     * @param int $code
     * @return \Illuminate\Http\JsonResponse
     */
    protected function error($errorMsg = 'error', $data = [], $code = 400)
    {
        return response()->json(['code' => $code, 'msg' => $errorMsg, 'data' => $data]);
    }

}
