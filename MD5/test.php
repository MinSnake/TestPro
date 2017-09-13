<?php
$gameid = '11822';
$openid = 'f8723d1ca332f4da9546ff2e1510b7bb';
$sessionid = '162b3065d2fb6c00fe497e63335b3ab1059b7d26e';
$secret = '0d833dddfc7bf6f2a997';
$encryptStr = "openid=$openid&sessionid=$sessionid&secret=$secret";

echo '加密原串：' . $encryptStr . PHP_EOL;
echo '加密后：' . md5($encryptStr) . PHP_EOL;