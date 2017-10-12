<?php

/**
 * @todo PHP中闭包和use的简单使用方式
 *
 * @param $type
 * @return mixed
 */


function test($type)
{
    $temp = 'saki';

    $show_name = function ($name) use ($temp)
    {
        echo $name . '-name-' . $temp;
    };

    $show_age = function ($age) use ($temp)
    {
        echo $age . '-age-' . $temp;
    };

    return $$type;
}


$test = test('show_name');
echo $test('123');
























