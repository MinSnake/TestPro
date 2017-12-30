<?php
include dirname(__DIR__).'/bootstrap.php';

$data = _string('11, 33, 22, 44,12,32,55,23,19,23')->split(',')->each(function(&$item){
    $item = intval($item);
})->sort(SORT_NUMERIC)->toArray();

var_dump($data);