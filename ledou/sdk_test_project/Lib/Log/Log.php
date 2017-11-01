<?php

namespace Lib\Log;


class Log
{


    public static function log($str)
    {
        if (!isset($_SERVER['SHELL'])) {
            $end = '<br>';
        } else {
            $end = PHP_EOL;
        }
        print '[' . date('Y-m-d H:i:s', time()) . '] ' . $str . $end;
    }


}