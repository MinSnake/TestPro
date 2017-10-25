<?php
include 'auth/Auth.php';

$game_key_secret = array(
    'key' => 'e19081b4527963d70c7a',
    'secret' => '8b61acd14a5811186163'
);

$token_key_secret = array(
    'key' => '',
    'secret' => ''
);

$Fetch_request = new Fetch_request_token();

$param_header = array(
    'oauth_consumer_key' => $game_key_secret['key'],
    'oauth_signature_method' => 'HMAC-SHA1',
    'oauth_timestamp' => (string)time(),
    'oauth_nonce' => '58111111-FA79-4A52-BB44-4E376CC0C624',
    'oauth_version' => '1.0',
);


//测试地址
$host = "http://secure.overseas.ids111.com";

//$host = "http://xiuxian.secure.yazhou.me";

$url = $host . "/oauth/request_token";

echo $url . '<br>';


var_dump($param_header);

/** @var TYPE_NAME $base_string */
$base_string = $Fetch_request->base_string('POST', $url, $param_header, array());

var_dump($base_string);

$OAuthSignature = new OAuthSignatures($game_key_secret['secret'], $token_key_secret['secret']);


$rre = $OAuthSignature->hashsign($base_string);

var_dump($rre);


$head_test_str = '';
foreach ($param_header as $key => $val) {
    $head_test_str .= $key . '=' . '"' . $val . '",';
}
$head_test_str = 'OAuth ' . $head_test_str;
$head_test_str = substr($head_test_str, 0, -1);
$headers_test = array(
    'Authorization' => $head_test_str
);


print 'Authorization: ' . $headers_test['Authorization'] . ',oauth_signature="' . urlencode($rre) . '",oauth_signature_v2="' . urlencode($rre) . '"';


