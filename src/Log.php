<?php
/**
 * @Project: pls
 * @Author : changren
 * @Time   : 2022/3/31 11:52
 */

include_once "composer/plugins/autoload.php";
include_once "EasyLogger.php";

class Log
{

    /**
     * @return Monolog\Logger
     */
    private static function getMonoLogger()
    {
        static $logger = null;
        if(!$logger){
            $logger = EasyLogger::getLogger(__CLASS__);
        }

        return $logger;

    }


    /**
     * debug级别日志
     *
     * @param string $message     日志信息
     * @param string $className  类名|类型
     * @param array  $context    追加内容
     */
    public static function debug(string $message, array $context = array(), string $className=''): void
    {
        self::getMonoLogger()->debug(self::getMessage($className,$message),$context);
    }



    public static function info(string $message, array $context = array(), string $className=''): void
    {
        self::getMonoLogger()->info(self::getMessage($className,$message),$context);
    }



    public static function notice(string $message, array $context = array(), string $className=''): void
    {
        self::getMonoLogger()->notice(self::getMessage($className,$message),$context);
    }



    public static function warning(string $message, array $context = array(), string $className=''): void
    {
        self::getMonoLogger()->warning(self::getMessage($className,$message),$context);
    }



    public static function error(string $message, array $context = array(), string $className=''): void
    {
        self::getMonoLogger()->error(self::getMessage($className,$message),$context);
    }



    public static function critical(string $message, array $context = array(), string $className=''): void
    {
        self::getMonoLogger()->critical(self::getMessage($className,$message),$context);
    }



    public static function alert(string $message, array $context = array(), string $className=''): void
    {
        self::getMonoLogger()->alert(self::getMessage($className,$message),$context);
    }



    public static function emergency(string $message, array $context = array(), string $className=''): void
    {
        self::getMonoLogger()->emergency(self::getMessage($className,$message),$context);
    }



    /**
     * 组装日志信息
     *
     * @param string $message
     * @param string $className
     * @param array $other
     */
    private static function getMessage(string $className, string $message)
    {
        $className = $className ? 'TYPE:'.$className.'| ' : '';
        return "{$className}{$message}";
    }


}
