<?php
// 记录开始运行时间
$GLOBALS['_beginTime'] = microtime(TRUE);
// 类文件后缀
const EXT = '.php';

// 系统常量定义
defined('LIB_PATH')  or define('LIB_PATH',   __DIR__ . '/');
defined('CORE_PATH') or define('CORE_PATH',  LIB_PATH . 'Core/');
defined('APP_PATH')  or define('APP_PATH',   LIB_PATH . 'App/');


require CORE_PATH . 'Core' . EXT;
\Lib\Core\Core::start();