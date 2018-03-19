<?php
require 'Rsa.php';
//设备系统，1：ios，2：android   默认ios
$device = intval($_GET['device']);
$type = intval($_GET['type']); //1-weplay,2-其他
$id = $_GET['id'];

if ($type === 1) {
    if ($device === 1) {
        $rsa = Rsa::getInstance('weplay/ios/privkey.pem', 'weplay/ios/pubkey.pem');
    } else {
        $rsa = Rsa::getInstance('weplay/android/privkey.pem', 'weplay/android/pubkey.pem');
    }
} else {
    // 使用其他方式的RSA加密文件
    if ($device === 1) {
        $rsa = Rsa::getInstance('other/ios/privkey.pem', 'other/ios/pubkey.pem');
    } else {
        $rsa = Rsa::getInstance('other/android/privkey.pem', 'other/android/pubkey.pem');
    }
}
$xx = $rsa->pubEncrypt($id);
header('Content-Type: text/plain');
echo $xx;