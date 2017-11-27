<?php
$orderInfo['dgc_amount'] = 0.01 * 0.22;

echo $orderInfo['dgc_amount'] ;

echo '<br>';

echo round(floatval($orderInfo['dgc_amount']), 2);