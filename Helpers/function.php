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

if (!function_exists('isPhoneNumber')) {

    /** 判断是否是手机号码
     * @param $phoneNumber
     * @return bool
     */
    function isPhoneNumber($phoneNumber)
    {
        return preg_match('/^[0-9]{7,15}$/', $phoneNumber) > 0;
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

/**
 * https://www.cnblogs.com/yaoliuyang/p/14648363.html
 * 打印原生sql 语句
 */
if (!function_exists('sql_dump')) {
    function sql_dump()
    {
        \DB::listen(function ($sql) {
            $i = 0;
            $bindings = $sql->bindings;
            $rawSql = preg_replace_callback('/\?/', function ($matches) use ($bindings, &$i) {
                $item = isset($bindings[$i]) ? $bindings[$i] : $matches[0];
                $i++;
                return gettype($item) == 'string' ? "'$item'" : $item;
            }, $sql->sql);

            $sql_time = $sql->time; # sql执行时间
            # 打印返回sql原生语句 & sql执行时间
            echo $rawSql, "\n<br /><br />\n"
                .
                "<strong style='color: #AA3333'>sql_run_time:</strong>  " . "<span style='font-style: italic;color: #1e7e34'>$sql_time</span>";
        });
    }
}
