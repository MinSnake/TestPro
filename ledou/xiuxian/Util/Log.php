<?php
/**
 * Created by PhpStorm.
 * User: jinda.li
 * Date: 2017/10/25
 * Time: 20:31
 */

namespace Util;


class Log
{

    public static function log($str)
    {
//        print '[' . date('Y-m-d H:i:s', time()) . '] ' . $str . PHP_EOL;
        print '[' . date('Y-m-d H:i:s', time()) . '] ' . $str . '<br>' . PHP_EOL;
    }

}