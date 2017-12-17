<?php
require 'Rsa.php';
$rsa = Rsa::getInstance('privkey.pem', 'pubkey.pem');

/**
 * 请求参数：openid    微信的openid     openid
 *          nickname  微信昵称         nickname
 *          gender    微信的性别       sex   1为男性，2为女性
 *          avatar    微信的头像       headimgurl
 *          unionid   微信用户统一标识  unionid
 *          province  微信用户省份      province
 *          city      微信用户城市      city
 */
$data = array(
    'openid' => 'abcdefg123',
    'nickname' => 'test_nickname',
    'gender' => 1,
    'avatar' => 'http://wx.qlogo.cn/mmhead/Icrr489G6ia6fjMmibGicedcpaawDicFFdlCTPHDeQFR6Z0/0/132',
    'unionid' => 'qwer456',
    'province' => '广东省',
    'city' => '深圳市',
);

$msg = json_encode($data);

$ret = $rsa->pubEncrypt($msg);

echo $ret . '<br>';

echo '用私钥解密' . '<br>';

$de_msg = $rsa->privDecrypt($ret);

echo $de_msg;

