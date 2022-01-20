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