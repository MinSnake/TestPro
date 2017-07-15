<?php
// 记录开始运行时间
$GLOBALS['_beginTime'] = microtime(TRUE);
// 记录内存初始使用
define('MEMORY_LIMIT_ON', function_exists('memory_get_usage'));
if (MEMORY_LIMIT_ON) {
    $GLOBALS['_startUseMems'] = memory_get_usage();
}


// 版本信息
const SAKI_VERSION     =   '1.0.0';


//定义系统常量
defined('FRAME_PATH') or define('FRAME_PATH', __DIR__.'/');   //框架根目录
defined('LIB_PATH') or define('LIB_PATH', FRAME_PATH.'Lib/'); // 系统核心类库目录

require LIB_PATH . 'Main.php';