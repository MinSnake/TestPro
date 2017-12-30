<?php
require 'Rsa.php';
$rsa = Rsa::getInstance('android/privkey.pem', 'android/pubkey.pem');

/**
 * 请求参数：openid    微信的openid     openid
 *          nickname  微信昵称         nickname
 *          gender    微信的性别       sex   1为男性，2为女性
 *          avatar    微信的头像       headimgurl
 *          unionid   微信用户统一标识  unionid
 *          province  微信用户省份      province
 *          city      微信用户城市      city
 */

$openid = md5(time() . rand(1, 4325));
$openid = substr($openid, 0, 18);
$openid = 'ozr3OvlwJDvVFTTakaDrMITo77ngxxxx';

$unionid = md5(time() . rand(3423, 988645));
$unionid = substr($unionid, 0, 20);
//$unionid = '';


var_dump($openid);
var_dump($unionid);

/**
 *  define('PLATFORM_LEDOU', 1);//乐逗用户中心(手机或帐号)
    define('PLATFORM_WECHAT', 2);//微信
    define('PLATFORM_QQ', 3);//QQ
    define('PLATFORM_EMAIL', 4);//EMAIL
 */

$data = array(
    'platform' => 2,
    'openid' => $rsa->pubEncrypt($openid),
    'nickname' => 'qwert',
    'gender' => 1,
    'avatar' => 'http://wx.qlogo.cn/mmhead/Icrr489G6ia6fjMmibGicedcpaawDicFFdlCTPHDeQFR6Z0/0/132',
    'unionid' => $rsa->pubEncrypt($unionid),
    'province' => '广东省',
    'city' => '深圳市',
);

var_dump($data);

foreach ($data as $k => $v) {
    echo $k . ':' . $v . '<br>';

}

//$msg = json_encode($data);
//$ret = $rsa->pubEncrypt($msg);
//echo $ret . '<br>';
//echo '用私钥解密' . '<br>';
//$de_msg = $rsa->privDecrypt($ret);
//echo $de_msg;

