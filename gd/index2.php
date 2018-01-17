<?php
//ini_set('max_execution_time', '0');

$a = rand(375, 700);
$b = rand(900, 1000);

//while (true) {

//for ($i = 0; $i < 100000; $i++) {
exec('adb shell input tap ' . $a . ' ' . $b);

//    if (($i % 10) == 0)
//    {
//        exec('adb shell input tap ' . 900 . ' ' . 1300);
//    }
//}

//ab -n 2000 -c 500 http://local.win.me/index2.php

$time = rand(100, 900);
usleep($time);