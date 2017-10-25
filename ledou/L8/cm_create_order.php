<?php
include 'auth/Auth.php';

$oauth_secret_key = array(
    'oauth_consumer_key' => 'e19081b4527963d70c7a',
    'oauth_consumer_secret' => '8b61acd14a5811186163',
);

$oauth_consumer_secret = array(
    'oauth_token' => '1e17ec2b662eac9142997ffbbd94c00e059eef5e3',
    'oauth_secret' => '335b0bf7bae2f1c768373d0225ece4ac'
);



//测试地址
$http_url = "http://sdkpay.overseas.ids111.com/payments/create";

//线上地址
//$http_url = "http://kor-olpay.ldoverseas.com/payments/create";


$Fetch_request = new Fetch_request_token();

$time = time();

//$time = 1502094090;

//$headers=array(
//    'Authorization'=>'OAuth oauth_consumer_key="'.$oauth_secret_key['oauth_consumer_key'].
//        '", oauth_token="'.$oauth_consumer_secret['oauth_token'].
//        '", oauth_signature_method="HMAC-SHA1",oauth_timestamp="'.$time.
//        '", oauth_nonce="-6696194299137986758", oauth_version="1.0"');

$head_test_arr = array(
    'oauth_consumer_key' => $oauth_secret_key['oauth_consumer_key'],
    'oauth_token' => $oauth_consumer_secret['oauth_token'],
    'oauth_signature_method' => 'HMAC-SHA1',
    'oauth_timestamp' => $time,
    'oauth_nonce' => '58111111-FA79-4A52-BB44-4E376CC0C624',
    'oauth_version' => '1.0',
);


$head_test_str = '';
foreach ($head_test_arr as $key => $val) {
    $head_test_str .= $key . '=' . '"' . $val . '",';
}

$head_test_str = 'OAuth ' . $head_test_str;
$head_test_str = substr($head_test_str, 0, -1);


$headers = array(
    'Authorization' => $head_test_str
);

$param_header = $Fetch_request->get_parameter_header($headers);

$http_method = 'POST';

$params = array(
    "product_id" => "13222",  //道具id,13位
    "product_name" => "金达测试道具",            //道具名称
    "p_identifier" => "com.jinda.test.fortumo.001",           //道具标识
    "quantity" => "1",          //数量
    "auth_game_type" => "1",              //游戏类型，1-网游，2-休闲
    "paymethod" => "401",         //支付方式标识
    "currency" => "USD",         //订单币种
    "order_amount" => "1.0900",          //支付金额
    "type" => "2",             //支付形式
    "extral_info" => "string",       //透传字段
    "price" => "1.0900",          //道具价格
    "channel_id" => "NT0S0N00002",   //渠道号
    "server_id" => "1",             //游戏服务器
    "cli_ver" => "pay-3.2.2.57",    //版本号
    "imei" => "000000000000",
    "nudid" => "18682168085186821680851868216808518682168085",
    "udid" => "JindaLiJindaLiJindaLiJindaLiJindaLiJindaLiJindaLiJindaLi"
);

var_dump(var_export(json_encode($params), true));


$base_string = $Fetch_request->base_string($http_method, $http_url, $param_header);

$base_string2 = $Fetch_request->base_string($http_method, $http_url, $param_header, $params);


$OAuthSignature = new OAuthSignatures($oauth_secret_key['oauth_consumer_secret'], $oauth_consumer_secret['oauth_secret']);


$rre = $OAuthSignature->hashsign($base_string);
$rres = $OAuthSignature->hashsign($base_string2);

var_dump(urlencode($rre));
var_dump(urlencode($rres));


print 'Authorization: ' . $headers['Authorization'] . ',oauth_signature="' . urlencode($rre) . '",oauth_signature_v2="' . urlencode($rres) . '"';




