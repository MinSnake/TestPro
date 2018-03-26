<?php

function makeReturn($code, $data = [])
{
    return json_encode([
        'code' => $code,
        'data' => $data
    ]);
}

if (!isset($_GET['token']) || empty($_GET['token'])) {
    echo makeReturn(400);
    exit();
}
$token = $_GET['token'];
//设备系统，1：ios，2：android   默认ios
$device = (!isset($_GET['device']) || empty($_GET['device'])) ? 1 : intval($_GET['device']);

if ($device === 1) {
    $ua = 'User-Agent:weplay/10101 (iPhone; iOS 9.3.5; Scale/2.00) | channel=NearDev&version=10300&phoneType=iPhone 6s&buildVersion=10_svn_9009';
} else {
    $ua = 'User-Agent:weplay/10101 (Xiaomi; Android 7.1.1; Scale/2.00) | channel=NearDev&version=10300&phoneType=Xiaomi MI 6 &buildVersion=10_svn_9009';
}

$now_time = time();
$sign = md5($now_time . '&weplay&' . $token);
$auth = 'Authorization:OAuth token='.$token.'&timestamp='.$now_time.'&sign='.$sign;

header('Content-Type: text/plain');
echo $ua;
echo PHP_EOL;
echo $auth;