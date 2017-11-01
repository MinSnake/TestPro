<?php

namespace Lib\Core;


class Core
{

    public static function start()
    {
        spl_autoload_register('Lib\Core\Core::autoload');



        self::run();
    }


    /**
     * @todo 自动加载处理
     * @param $class
     */
    public static function autoload($class)
    {
        echo $class;
        if (TEST_APP_TYPE == 'CM')
        {

        }
        elseif(TEST_APP_TYPE == 'OL')
        {

        }
        else
        {
            die('测试类型配置错误');
        }
    }


    /**
     * @todo 测试程序总入口
     */
    public static function run()
    {
        foreach (TEST_APP_LIST as $module_name => $api_name) {





        }
    }

}