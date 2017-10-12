<?php
include 'auth/Auth.php';

//$oauth_secret_key = array(
//    'oauth_consumer_key' => '67a671523a3b098cf561',
//    'oauth_consumer_secret' => '6422592d6968c87d1132',
//);
$oauth_secret_key = array(
    'oauth_consumer_key' => '8fee977f5ba1244dc4f1',
    'oauth_consumer_secret' => '02f1221f49bb90bc68f3',
);

//测试地址
$api = "http://wangyou.feed.meizhou.me"; //本地

$api = "http://test.zzz.in1.feed.ids111.com"; //局域网测试机

//线上地址


$url = "/fortumo/payinfo";


$Fetch_request = new Fetch_request_token();
$timestamp = time();
$timestamp = 1505722555;

$head_arr = array(
    'oauth_consumer_key' => $oauth_secret_key['oauth_consumer_key'],
    'oauth_nonce' => '58E27606-FA79-4A52-BB44-4E376CC0C624',
    'oauth_timestamp' => $timestamp,
    'oauth_version' => '1.0',
    'oauth_signature_method' => 'HMAC-SHA1',
);

$head_str = '';

foreach ($head_arr as $key => $val) {
    $head_str .= $key . '=' . '"' . $val . '",';
}
$head_str = 'OAuth ' . $head_str;
$head_str = substr($head_str, 0, -1);

$headers_test = array(
    'Authorization' => $head_str
);

//var_dump($headers_test);

$param_header = $Fetch_request->get_parameter_header($headers_test);

var_dump($param_header);

$http_method = 'POST';
$http_url = $api . $url;
$params = array();


$base_string = $Fetch_request->base_string($http_method, $http_url, $param_header, $params);

var_dump($base_string);

$OAuthSignature = new OAuthSignatures($oauth_secret_key['oauth_consumer_secret'], '');


$rre = $OAuthSignature->hashsign_game($base_string);

var_dump($rre);
var_dump(urlencode($rre));

print 'Authorization: ' . $headers_test['Authorization'] . ',oauth_signature="' . urlencode($rre) . '"';


