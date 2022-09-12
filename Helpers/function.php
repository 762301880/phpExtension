<?php

/**
 * 加敏手机号
 * @param int $phoneNumber 手机号码
 */
if (!function_exists('encryptPhoneNumber')) {
    function encryptPhoneNumber($phoneNumber)
    {
        return substr_replace($phoneNumber, '****', 3, 4);
    }
}

/** 判断是否是手机号码
 * @param $phoneNumber
 * @return bool
 */
if (!function_exists('isPhoneNumber')) {
    function isPhoneNumber($phoneNumber)
    {
        return preg_match('/^[0-9]{7,15}$/', $phoneNumber) > 0;
    }
}

/**
 * 远程http请求
 * @param $url
 * @param $post_data
 * @param $data
 * @return bool|string
 */
if (!function_exists('curl_request')) {
    function curl_request($url = '', $post_data = [], $data = [])
    {
        $cookie = !empty($data['cookie']) ? $data['cookie'] : "";
        $ch = curl_init();//初始化curl
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);//在尝试连接时等待的秒数。设置为0，则无限等待
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json;charset=utf-8'));
        curl_setopt($ch, CURLOPT_URL, $url);//需要获取的 URL 地址
        curl_setopt($ch, CURLOPT_HEADER, 0);//设置header param:1
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);//要求结果为字符串且输出到屏幕上
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); //禁止 cURL 验证对等证书
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false); //是否检测服务器的域名与证书上的是否一致
        if (!empty($post_data)) { # 如果提交的参数请求不为空
            curl_setopt($ch, CURLOPT_POST, 1);//post提交方式
            curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);//提交的参数
        }
        if (!empty($cookie)) { # 如果有cookie传递cookie
            curl_setopt($ch, CURLOPT_COOKIE, $cookie);
        }
        $data = curl_exec($ch);//运行curl
        curl_close($ch); # 关闭curl请求
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
                "<strong style='color: #aa3333'>sql_run_time:</strong>  " . "<span style='font-style: italic;color: #1e7e34'>$sql_time</span>";
        });
    }
}

if (!function_exists('getBeforeTime')) {
    /**
     * 计算序列化时间
     * 调用示例 dd(getBeforeTime(strtotime('1997-08-11 09:10:12')));
     */
    function getBeforeTime($time)
    {
        //闭包序列化时间 int格式
        $serializeTime = function ($time) {
            if (is_int($time)) $time = (int)$time;
            if (is_string($time)) $time = strtotime($time);
            return $time;
        };
        $thisTime = (new DateTime())->format('Y-m-d H:i:s');
        $thisTime = (new DateTime($thisTime))->getTimestamp();
        if ($thisTime < $time) throw new Exception("需要转化的时间不能大于当前的日期");
        $time = $serializeTime($time);
        $seconds = 60;//60秒
        $minutes = $seconds * $seconds;//1小时
        $hours = $minutes * 24;//一天
        $month = $hours * 30;//一个月
        $year = $month * 12;//一年
        $max_year = $year * 100;//最大年份100年
        echo "当前时间为:" . $thisTime;
        echo "需要转化的时间为:" . $time;
        $timeDiff = $thisTime - $time;
        echo "时间差为:" . $timeDiff;

        if ($timeDiff < $seconds) return $timeDiff . '秒之前';
        if ($timeDiff < $minutes) return floor($timeDiff / $seconds) . '分钟之前';
        if ($timeDiff < $hours) return floor($timeDiff / $minutes) . '小时之前';
        if ($timeDiff < $month) return floor($timeDiff / $hours) . '天之前';
        if ($timeDiff < $year) return floor($timeDiff / $month) . '个月之前';
        if ($timeDiff > $year && $timeDiff < $max_year) return floor($timeDiff / $year) . "年之前";
        return date('Y-m-d H:i:s', $time); //超过100年返回具体时间
    }
}
