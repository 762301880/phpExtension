<?php

/**
 * 打印最后一条执行sql
 */
if (!function_exists('getLastSql')) {
    function getLastSql()
    {
        \think\facade\Db::listen(function($sql, $time, $explain){
            // 记录SQL
            echo $sql. "&nbsp &nbsp &nbsp &nbsp".' ['.$time.'s]';
            // 查看性能分析结果
            echo "<br><br>".$explain;
        });
    }
}


/**
 * 推荐使用  打印全部的sql
 * https://doc.thinkphp.cn/v5_1/jiantingSQL.html
 */
if (!function_exists('sqlPrint')) {
    function sqlPrint()
    {
        \Db::listen(function($sql, $time, $explain){
            // 记录SQL
            echo $sql . ' [' . $time . 's]';
            // 查看性能分析结果
            dump($explain);
        });
    }
}
