<?php
/**
 * 二次开发系统配置
 * @Project: pls
 * @Author : changren
 * @Time   : 2022/3/31 9:21
 */


use Monolog\Logger;


return array(

#-----------------------------------------------------------------------------------------------------------------------
# monolog日志配置
#-----------------------------------------------------------------------------------------------------------------------
    'monolog' => array(

        # 日志级别
        'level' => Logger::INFO,

        # 日期格式
        'dateFormat'=>'Y-m-d H:i:s',

        # 日志信息输出格式{message(日志信息),level(日志级别数字),level_name(日志级别),channel(类名),datetime(时间),context(日志详细信息),extra}
        'messageFormat' => "[%datetime%] %level_name% %channel% %message% %context% \n",

        # 日志存放目录
        'path' => "upload/monolog/".date('Y-m',time())."/MONO.log",
    )


);
