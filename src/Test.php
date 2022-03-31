<?php
include_once "Log.php";
include_once "EasyLogger.php";
class Test
{
    private $data = array( ['id'=>1,'name'=>'小明'],['id'=>2,'name'=>'小红'] );

    public function __construct()
    {

        // 构建monolog日志处理器
        $log = EasyLogger::getLogger(__CLASS__);

        $log->debug('debug调试');
        $log->info("用户数据",$this->data);
        $log->error("出错啦");
        $log->notice("请注意有BUG");
        $log->warning("错误信息");
        // 更多方法 ...

        #---------------------------------------------------------------------------------------------------------------
        Log::info("info信息");
        Log::error("错误信息");
        Log::warning("错误信息");
    }

}

new Test();