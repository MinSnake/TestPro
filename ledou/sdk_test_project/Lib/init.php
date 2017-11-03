<?php
// 记录开始运行时间
$GLOBALS['_beginTime'] = microtime(TRUE);
// 类文件后缀
const EXT = '.php';

// 系统常量定义
defined('LIB_PATH')        or define('LIB_PATH',       ROOT_PATH . 'Lib/');
defined('LIB_CORE_PATH')   or define('LIB_CORE_PATH',  LIB_PATH  . 'Core/');
defined('LIB_APP_PATH')    or define('LIB_APP_PATH',   LIB_PATH  . 'App/');
defined('LIB_LOG_PATH')    or define('LIB_LOG_PATH',   LIB_PATH  . 'Log/');


defined('CONFIG_PATH')     or define('CONFIG_PATH', ROOT_PATH . 'Config/');
defined('APP_PATH')        or define('APP_PATH',    ROOT_PATH . 'App/');
defined('APP_CM_PATH')     or define('APP_CM_PATH', APP_PATH  . 'Cm/');
defined('APP_OL_PATH')     or define('APP_OL_PATH', APP_PATH  . 'Ol/');


require LIB_CORE_PATH . 'Core' . EXT;
\Lib\Core\Core::start();