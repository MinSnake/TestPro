<?php

//echo round(floatval(0.1 * 0.22), 2);
//echo '<br>';
//echo round(floatval(0.02), 2);

$dataArr['total_fee'] = 2;
$order['price'] = 0.1000;
$order['rate'] = 0.2200;

echo intval($order['price'] * 100 * $order['rate']) . '<br>';


if(intval($dataArr['total_fee']) !== intval($order['price'] * 100 * $order['rate'])){
    echo '000';
}
else
{
    echo '1111';
}