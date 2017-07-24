<?php
include 'auth/Auth.php';

$oauth_secret_key = array(
    'oauth_consumer_key' => '67a671523a3b098cf561',
    'oauth_consumer_secret' => '6422592d6968c87d1132',
);


$oauth_consumer_secret = array(
    'oauth_token' => 'c05e30214fc58314bbc6878b168917c505971b9a7',
    'oauth_secret' => 'ee73cd1aff2846a46b27572826881111'
);


$api = "http://test.zzz.secure.ids111.com:97";

$url = "/oauth/authenticate";


$Fetch_request = new Fetch_request_token();
$time = time();
$head_test_arr = array(
    'oauth_consumer_key' => $oauth_secret_key['oauth_consumer_key'],
    'oauth_token' => $oauth_consumer_secret['oauth_token'],
    'oauth_signature_method' => 'HMAC-SHA1',
    'oauth_timestamp' => $time,
    'oauth_nonce' => '58E27606-FA79-4A52-BB44-4E376CC0C624',
    'oauth_version' => '1.0',
);


//$head_test_arr = array(
//    'oauth_consumer_key'     => '67a671523a3b098cf561',
//    'oauth_token'            => '815586d4e372151aa652c450c268ffa905971aa0a',
//    'oauth_signature_method' => 'HMAC-SHA1',
//    'oauth_timestamp'        => '1500621322',
//    'oauth_nonce'            => '58E27606-FA79-4A52-BB44-4E376CC0C624',
//    'oauth_version'          => '1.0',
////    'oauth_signature'        => 'kanyou22ryoHdYVjo%2Frf97u0eBA%3D'
//    //oauth_signature=\"kanyou22ryoHdYVjo%2Frf97u0eBA%3D\",
//);


$head_test_str = '';
foreach ($head_test_arr as $key => $val) {
    $head_test_str .= $key . '=' . '"' . $val . '",';
}

//var_dump($head_test_str);
$head_test_str = 'OAuth ' . $head_test_str;
$head_test_str = substr($head_test_str, 0, -1);

//var_dump($head_test_str);

$headers_test = array(
    'Authorization' => $head_test_str
);

//var_dump($headers_test);

$param_header = $Fetch_request->get_parameter_header($headers_test);

//var_dump($param_header);

$http_method = 'POST';
$http_url = $api . $url;
$params = array();


$base_string = $Fetch_request->base_string($http_method, $http_url, $param_header, $params);

var_dump($base_string);

$OAuthSignature = new OAuthSignatures($oauth_secret_key['oauth_consumer_secret'], $oauth_consumer_secret['oauth_secret']);


$rre = $OAuthSignature->hashsign($base_string);

var_dump(urlencode($rre));

print 'Authorization: ' . $headers_test['Authorization'] . ',oauth_signature="' . urlencode($rre) . '"';




