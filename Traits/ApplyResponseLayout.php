<?php


namespace App\Traits;


trait ApplyResponseLayout
{

    /**
     * 成功返回
     * @param string $successMsg
     * @param array $data
     * @param int $code
     * @return \Illuminate\Http\JsonResponse
     */
    protected function success($successMsg = 'success', $data = [], $code = 200)
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
    protected function error($errorMsg = 'error', $data = [], $code = 5000)
    {
        return response()->json(['code' => $code, 'msg' => $errorMsg, 'data' => $data]);
    }

}
