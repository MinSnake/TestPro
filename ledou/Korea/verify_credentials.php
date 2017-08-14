<?php
include 'auth/Auth.php';

$oauth_secret_key = array(
    'oauth_consumer_key' => '67a671523a3b098cf561',
    'oauth_consumer_secret' => '6422592d6968c87d1132',
);

$oauth_consumer_secret = array(
    'oauth_token' => '2a14c8bb7499d7fd96b6a930eca2a7500598a9449',
    'oauth_secret' => 'a0b5820755dd32200454f7f4a1f37e2d'
);


//测试地址
$http_url = "http://test.zzz.feed.ids111.com:97/account/verify_credentials";

//线上地址
//$http_url = "http://kor-olfeed.ldoverseas.com/account/verify_credentials";

$Fetch_request = new Fetch_request_token();

echo $http_url . '<br>';


$time = time();

//$headers=array('Authorization'=>'OAuth oauth_consumer_key="0bb9be981116a83534b7", oauth_token="6368feb43ecc532271494017766acac5059278894", oauth_signature_method="HMAC-SHA1", oauth_signature="3Z6AoZAPuWF20cOX4v%2FQNJbuchQ%3D", oauth_timestamp="1472438988", oauth_nonce="-5088990226636127275", oauth_version="1.0", oauth_signature_v2="1GXEXEcMS7N51ZYl14NEcf%2BjHNY%3D"');
//$headers = array('Authorization' => 'OAuth oauth_consumer_key="' . $oauth_secret_key['oauth_consumer_key'] . '", oauth_token="' . $oauth_consumer_secret['oauth_token'] . '", oauth_signature_method="HMAC-SHA1",oauth_timestamp="' . $time . '", oauth_nonce="58E27606-FA79-4A52-BB44-4E376CC0C624", oauth_version="1.0"');


$head_test_arr = array(
    'oauth_consumer_key' => $oauth_secret_key['oauth_consumer_key'],
    'oauth_token' => $oauth_consumer_secret['oauth_token'],
    'oauth_signature_method' => 'HMAC-SHA1',
    'oauth_timestamp' => $time,
    'oauth_nonce' => '58E27606-FA79-4A52-BB44-4E376CC0C624',
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

$http_method = 'GET';

$params = array();


$base_string = $Fetch_request->base_string($http_method, $http_url, $param_header, $params);


$OAuthSignature = new OAuthSignatures($oauth_secret_key['oauth_consumer_secret'], $oauth_consumer_secret['oauth_secret']);


$rre = $OAuthSignature->hashsign($base_string);

var_dump(urlencode($rre));


print 'Authorization: ' . $headers['Authorization'] . ',oauth_signature="' . urlencode($rre) . '",oauth_signature_v2="' . urlencode($rre) . '"';




