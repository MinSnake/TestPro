<?php

namespace Util;
/**
 * Created by PhpStorm.
 * User: jinda.li
 * Date: 2017/10/25
 * Time: 20:17
 */
class ToolUtil
{

    public static function getMillisecond()
    {
        list($t1, $t2) = explode(' ', microtime());
        return (float)sprintf('%.0f', (floatval($t1) + floatval($t2)) * 1000);
    }

}