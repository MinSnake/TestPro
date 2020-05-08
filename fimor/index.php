<?php
$token = $_GET['token'];
$time = time();
$version = $_GET['version'];
$data = [
    'access_token' => $token,
    'timestamp' => $time,
    'version' => $version,
    'type' => 'admin',
];
ksort($data);
$temp = [];
foreach ($data as $k => $v) {
    $temp[] = $k . '=' . urlencode($v);
}
$str = join('&', $temp);
$sign = md5($str);

echo 'Authorization:access_token=' . $token .
    '&timestamp=' . $time .
    '&sign=' . $sign .
    '&version=' . $version . '&type=admin';
