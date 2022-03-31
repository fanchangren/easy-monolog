# easy-monolog日志处理器
+ 文档版本: v1.0
+ PHP版本: 7.2+

###  一、说明

项目引用monolog日志处理器,并对其进行简单封装,方便快速上手使用


### 二、 类文件说明
[Config](src/Config.php) ---日志配置

[EasyLogger](src/EasyLogger.php)---monolog日志工厂,使用该类可根据配生成monolog日志处理器

[Log](src/Log.php)---使用单列模式生成,monolog日志器(EasyLogger简化版)

[LoggerFactoryInterface.](src/LoggerFactoryInterface.php)--- 日志工厂接口,monolog提供了强大的日志功能,
您可以实现该接口,订制自己的日志处理器


### 三、使用演示

#### 1. Config.php 日志配置

```php
return array(

// monolog日志配置
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

```


#### 2. 使用[EasyLogger](src/EasyLogger.php)获取monolog日志处理器

```php
include_once "EasyLogger.php";

// 构建monolog日志处理器
$log = EasyLogger::getLogger(__CLASS__);

$log->debug('debug调试');
$log->info("用户数据",$this->data);
$log->error("出错啦");
$log->notice("请注意有BUG");
$log->warning("错误信息");

```


#### 3. 使用[Log](src/Log.php)获取monolog日志处理器

```php
include_once "Log.php";

Log::info("info信息");
Log::error("错误信息");
Log::warning("错误信息");
```


#### 4. 日志演示

[查看日志文件](upload/monolog/2022-03/MONO-2022-03-31.log)
```log
[2022-03-31 20:59:58] INFO Test 用户数据 [{"id":1,"name":"小明"},{"id":2,"name":"小红"}] 
[2022-03-31 20:59:58] ERROR Test 出错啦 [] 
[2022-03-31 20:59:58] NOTICE Test 请注意有BUG [] 
[2022-03-31 20:59:58] WARNING Test 错误信息 [] 
[2022-03-31 20:59:58] INFO Log info信息 [] 
[2022-03-31 20:59:58] ERROR Log 错误信息 [] 
[2022-03-31 20:59:58] WARNING Log 错误信息 [] 
```


### 四、备注

1. 本项目引入了composer依赖,地址:/src/composer
2. 本项目仅仅是对monolog简单的封装,方便快速上手，monolog还有更多强大的功能
3. 对代码有任何疑问,欢迎留言、批评指正 作者邮箱:phpfan@163.com