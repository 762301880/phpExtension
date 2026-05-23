<?php


namespace traits;


trait ApplyResponseLayout
{

    /**
     * 成功返回
     * @param string $successMsg
     * @param array $data
     * @param int $code
     */
    protected function resSuccess($successMsg = 'success', $data = [])
    {
        return json(['code' => 0, 'msg' => $successMsg, 'data' => $data]);
    }


    /**
     * 错误返回
     * @param null $errorMsg
     * //为什么参数里面没有data因为错误只返回信息
     * @param int $code
     */
    protected function resError($errorMsg = 'error', $code = 1000)
    {
        return json(['code' => $code, 'msg' => $errorMsg, 'data' => null]);
    }

}
