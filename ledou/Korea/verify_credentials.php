<?php
include 'auth/Auth.php';

$oauth_secret_key = array(
    'oauth_consumer_key' => '67a671523a3b098cf561',
    'oauth_consumer_secret' => '6422592d6968c87d1132',
);

$oauth_consumer_secret = array(
    'oauth_token' => '036acfdb0077404cde43306b62c5f8ad0597aad23',
    'oauth_secret' => '3ec871aab1811af979220efc6cb9ec06'
);


$http_url = "http://test.zzz.feed.ids111.com:97/account/verify_credentials";

$Fetch_request = new Fetch_request_token();


$time = time();

//$headers=array('Authorization'=>'OAuth oauth_consumer_key="0bb9be981116a83534b7", oauth_token="6368feb43ecc532271494017766acac5059278894", oauth_signature_method="HMAC-SHA1", oauth_signature="3Z6AoZAPuWF20cOX4v%2FQNJbuchQ%3D", oauth_timestamp="1472438988", oauth_nonce="-5088990226636127275", oauth_version="1.0", oauth_signature_v2="1GXEXEcMS7N51ZYl14NEcf%2BjHNY%3D"');
$headers = array('Authorization' => 'OAuth oauth_consumer_key="' . $oauth_secret_key['oauth_consumer_key'] . '", oauth_token="' . $oauth_consumer_secret['oauth_token'] . '", oauth_signature_method="HMAC-SHA1",oauth_timestamp="' . $time . '", oauth_nonce="-4076884019643538433", oauth_version="1.0"');


$param_header = $Fetch_request->get_parameter_header($headers);

$http_method = 'GET';

$params = array();


$base_string = $Fetch_request->base_string($http_method, $http_url, $param_header, $params);


$OAuthSignature = new OAuthSignatures($oauth_secret_key['oauth_consumer_secret'], $oauth_consumer_secret['oauth_secret']);


$rre = $OAuthSignature->hashsign($base_string);

var_dump(urlencode($rre));


print 'Authorization: ' . $headers['Authorization'] . ',oauth_signature="' . urlencode($rre) . '",oauth_signature_v2="' . urlencode($rre) . '"';




