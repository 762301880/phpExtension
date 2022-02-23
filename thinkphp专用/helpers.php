<?php

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
