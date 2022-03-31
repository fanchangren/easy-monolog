<?php
/**
 * @Project: pls
 * @Author : changren
 * @Time   : 2022/3/31 9:49
 */

include_once "LoggerFactoryInterface.php";

use Monolog\Logger;
use Monolog\Formatter\LineFormatter;
use Monolog\Handler\RotatingFileHandler;

/**
 * 使用单列模式,构建monolog日志记录器
 *
 * @version v1.0
 */
class EasyLogger implements LoggerFactoryInterface
{

    /**
     * 配置文件地址
     */
    private const CONFIG_PATH = 'Config.php';


    /**
     * @var Monolog\Logger
     */
    private static $monoLoggerObj = null;


    private function __construct(){}


    /**
     *获取monolog日志处理器
     *
     * @param string $className
     * @return Logger
     */
    public static function getLogger(string $className): Logger
    {
        if (!(self::$monoLoggerObj instanceof Logger)) {

            try {
                // monolog日志处理器
                return (new EasyLogger())->createLogger($className);
            }catch (ErrorException $exception){
                die('<h3>'.$exception->getMessage().'</h3>');
            }

        }

        // 克隆$monoLoggerObj 并返回对象
        return self::$monoLoggerObj->withName($className);

    }


    /**
     * 构建monolog日志处理器
     *
     * @param string $className
     * @return Logger
     * @throws ErrorException
     */
    private function createLogger(string $className): Logger
    {
        $config = $this->getConfig();

        // 设置日志格式
        $lineFormatter = new LineFormatter($config->getMessageFormat(), $config->getDateFormat());

        // 创建处理器,设置日志路径,指定日志级别
        $streamHandler = new RotatingFileHandler($config->getPath(),0,$config->getLevel());
        $streamHandler->setFormatter($lineFormatter);

        $log = new Logger($className);
        $log->pushHandler($streamHandler);

        return self::$monoLoggerObj = $log;

    }


    /**
     * 获取monolog配置信息
     *
     * @return  MonologConfigEntity
     * @throws  ErrorException
     */
    private function getConfig(): MonologConfigEntity
    {
        $config = include(self::CONFIG_PATH);

        // monolog基础配置检查
        if (
            !array_key_exists('monolog', $config)
            || !array_key_exists('level', $config['monolog'])
            || !array_key_exists('dateFormat', $config['monolog'])
            || !array_key_exists('messageFormat', $config['monolog'])
            || !array_key_exists('path', $config['monolog'])
        ) {
            throw new ErrorException('请配置monolog的日志格式,基础配置必须包含[level=>,dateFormat=>,messageFormat=>,path=>]');
        }
        $config = $config['monolog'];

        $monoConfig = new MonologConfigEntity();
        $monoConfig->setLevel($config['level']);
        $monoConfig->setPath($config['path']);
        $monoConfig->setDateFormat($config['dateFormat']);
        $monoConfig->setMessageFormat($config['messageFormat']);

        return $monoConfig;
    }

}


/**
 * monolog日志配置实体
 */
class  MonologConfigEntity
{
    /**
     * @var string 日志等级
     */
    private $level;

    /**
     * @var string 日期格式
     */
    private $dateFormat;

    /**
     * @var string 日志信息格式  "[ %datetime% ] %level_name%  %message% %context% %extra% \n"
     */
    private $messageFormat;

    /**
     * @var string 路径
     */
    private $path;

    /**
     * @return string
     */
    public function getLevel(): string
    {
        return $this->level;
    }

    /**
     * @param string $level
     */
    public function setLevel(string $level): void
    {
        $this->level = $level;
    }

    /**
     * @return string
     */
    public function getDateFormat(): string
    {
        return $this->dateFormat;
    }

    /**
     * @param string $dateFormat
     */
    public function setDateFormat(string $dateFormat): void
    {
        $this->dateFormat = $dateFormat;
    }

    /**
     * @return string
     */
    public function getMessageFormat(): string
    {
        return $this->messageFormat;
    }

    /**
     * @param string $messageFormat
     */
    public function setMessageFormat(string $messageFormat): void
    {
        $this->messageFormat = $messageFormat;
    }

    /**
     * @return string
     */
    public function getPath(): string
    {
        return $this->path;
    }

    /**
     * @param string $path
     */
    public function setPath(string $path): void
    {
        $this->path = $path;
    }

}