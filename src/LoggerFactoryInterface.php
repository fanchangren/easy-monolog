<?php
/**
 * @Project: pls
 * @Author : changren
 * @Time   : 2022/3/31 9:45
 */

/**
 * monolog日志工厂,实现该接口定制自己的monolog日志处理器
 */
interface LoggerFactoryInterface
{
    /**
     * 获取日志处理器
     *
     * @param string $className
     * @return Monolog\Logger
     */
    public static function getLogger(string $className):Monolog\Logger;
}