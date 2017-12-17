<?php
require 'Rsa.php';
$rsa = Rsa::getInstance('privkey.pem', 'pubkey.pem');

$msg = '123123';

$ret = $rsa->pubEncrypt($msg);

echo $ret . '<br>';

echo '用私钥解密' . '<br>';

$de_msg = $rsa->privDecrypt($ret);

echo $de_msg;

