<?php

function splitVersion($versionStr)
{
    $arr = explode('_', $versionStr);
    if (count($arr) != 2)
    {
        return false;
    }
    return array(
        'game_version' => substr($arr[0], 1),
        'sdk_version' => substr($arr[1], 1)
    );
}



$arr = splitVersion('v1.0.0_s1.0.1');

var_dump($arr);