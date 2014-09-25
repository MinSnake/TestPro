<?php

$md5 = md5('395408934@qq.com');

$str = substr($md5,5,8);

echo strtoupper($str);