<?php
/**
 * Created by PhpStorm.
 * User: jinda.li
 * Date: 2017/7/19
 * Time: 11:52
 */

$data = array(
//    'udid' => false,
//    'nudid' => 1
);

if ((!isset($data['udid']) || empty($data['udid'])) &&
    (!isset($data['nudid']) || empty($data['nudid'])))
{
    echo 'false';
}
else
{
    echo 'pass';
}