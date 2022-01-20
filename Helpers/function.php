<?php


if (!function_exists('encryptPhoneNumber')) {
    /**
     * 加敏手机号
     * @param int $phoneNumber 手机号码
     */
    function encryptPhoneNumber($phoneNumber)
    {
        return substr_replace($phoneNumber, '****', 3, 4);
    }
}

if (!function_exists('httpPost')) {
    /**
     * 远程http请求
     * @param $url
     * @param $params
     * @return bool|string
     */
    function httpPost($url, $params)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json;charset=utf-8'));
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($params));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        // 线下环境不用开启curl证书验证, 未调通情况可尝试添加该代码
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        $data = curl_exec($ch);
        curl_close($ch);
        return $data;
    }
}