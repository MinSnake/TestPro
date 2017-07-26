<?php
include 'auth/Auth.php';


$oauth_secret_key = array(
    'oauth_consumer_key' => '05256a1728db60b36fd2',
    'oauth_consumer_secret' => 'f3221b8477864bb80727',
);

$oauth_consumer_secret = array(
    'oauth_token' => 'b3daf4de0140bcf88213aff39193f7f90596862af',
    'oauth_secret' => 'a9e4f90aad40b9fd80c1b6dbeb2683b0'
);


$http_url = "http://payv2.dev.ids111.com:97/payments/create";//?init=1&sdk_version=2.0&udid=00000000-60b2-e740-eb18-8bf30033c587&game_version=3.2.8&nudid=22826oos9396440_5085204153orp72r9&channel_id=LE0S0N30000";


$Fetch_request = new Fetch_request_token();


$time = time();


$headers = array('Authorization' => 'OAuth oauth_consumer_key="' . $oauth_secret_key['oauth_consumer_key'] . '", oauth_token="' . $oauth_consumer_secret['oauth_token'] . '", oauth_signature_method="HMAC-SHA1", oauth_timestamp="1497513304", oauth_nonce="-5334985442199657064", oauth_version="1.0"');


$param_header = $Fetch_request->get_parameter_header($headers);

$http_method = 'POST';

//$json = '{"product_id":"2511422445551","product_name":"金币","p_identifier":"test1","quantity":"1","auth_game_type":1,"paymethod":"64","currency":"TWD","order_amount":"6","type":8,"extral_info":"string","price":"2.0","channel_id":"NT0S0N00002","server_id":"1","cli_ver":"pay-3.2.2.57","imei":"864230031942103","nudid":"83q1q11n1_322911905487308411r854","udid":"00000000-439c-a1d4-ffff-ffff8c78a45e"}';


$params = array(
    "product_id" => "2511422445551",
    "product_name" => "金币",
    "p_identifier" => "test1",
    "quantity" => "1",
    "auth_game_type" => 1,
    "paymethod" => "64",
    "currency" => "TWD",
    "order_amount" => "6",
    "type" => 8,
    "extral_info" => "string",
    "price" => "2.0",
    "channel_id" => "NT0S0N00002",
    "server_id" => "1",
    "cli_ver" => "pay-3.2.2.57",
    "imei" => "864230031942103",
    "nudid" => "TEST498f0723-570c-4bbc-88ea-10000000003",
    "udid" => "TEST498f0723-570c-4bbc-88ea-10000000003"
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




