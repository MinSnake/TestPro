<?php

namespace Lib\Core;


use Lib\Log\Log;
use Lib\Tools\Tools;

class Core
{

    public static function start()
    {
        spl_autoload_register('Lib\Core\Core::autoload');
        self::load_config();
        self::run();
    }

    /**
     * @todo 加载配置文件
     */
    public static function load_config()
    {
        require CONFIG_PATH . 'bootstrap' . EXT;
        require CONFIG_PATH . TEST_APP_AREA . '/' . 'config' . EXT;
    }


    /**
     * @todo 自动加载处理
     * 先加载Config下的bootstrap.php的配置文件
     * 根据其中的测试游戏类型和区域去自动加载类文件
     * @param $class
     *
     * @author jinda.li
     * @date 2017年11月3日15:29:08
     */
    public static function autoload($class)
    {
        $class_arr = explode("\\", $class);
        $file_path = ROOT_PATH;
        foreach ($class_arr as $dir_name) {
            $file_path .= $dir_name . '/';
        }
        $file_path = substr($file_path, 0, strlen($file_path) - 1);
        $file_path = $file_path . EXT;
        require $file_path;
    }


    /**
     * @todo 测试程序总入口
     */
    public static function run()
    {
        foreach (TEST_APP_LIST as $app_config) {
            $module_name = $app_config[0];
            $api_name = $app_config[1];
            //解析类名首字母大写
            $class_name = 'App' . '\\' . TEST_APP_TYPE . '\\' . TEST_APP_AREA . '\\' . ucfirst($module_name);
            //根据配置获取到方法名
            $function_name = (string)ROUTES[$module_name][$api_name];
            //需要获取到命名空间
            $class_obj = new $class_name();
            Log::log("");
            Log::log("");
            Log::log("");
            Log::log("=====即将请求【" . $module_name . "】模块中的【" . $api_name . "】=====");
            $start_time = Tools::getMillisecond();
            $class_obj->$function_name();
            $end_time = Tools::getMillisecond();
            Log::log('流程结束，耗时：' . ($end_time - $start_time) . '毫秒');
            Log::log("=====结束请求【" . $module_name . "】模块中的【" . $api_name . "】=====");
            Log::log("");
            Log::log("");
        }
    }

}