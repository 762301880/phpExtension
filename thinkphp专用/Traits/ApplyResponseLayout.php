<?php


namespace app\Traits;


trait ApplyResponseLayout
{

    /**
     * 成功返回
     * @param string $successMsg
     * @param array $data
     * @param int $code
     */
    protected function success($data = [], $successMsg = 'success', $code = 200)
    {
        return json(['code' => $code, 'msg' => $successMsg, 'data' => $data]);
    }


    /**
     * 错误返回
     * @param null $errorMsg
     * @param array $data
     * @param int $code
     */
    protected function error($errorMsg = 'error', $data = [], $code = 400)
    {
        return json(['code' => $code, 'msg' => $errorMsg, 'data' => $data]);
    }

}
