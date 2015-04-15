<?php
$time = time();

$a = md5($time);

$c = substr(md5($time),0,8);

echo strtoupper($c);
?>