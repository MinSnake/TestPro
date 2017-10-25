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
        if (!isset($_SERVER['SHELL']))
        {
            $end = '<br>';
        }
        else
        {
            $end = PHP_EOL;
        }
        print '[' . date('Y-m-d H:i:s', time()) . '] ' . $str . $end;
    }

}