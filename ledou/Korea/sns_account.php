<?php
include 'auth/Auth.php';

$oauth_secret_key = array(
    'oauth_consumer_key' => '67a671523a3b098cf561',
    'oauth_consumer_secret' => '6422592d6968c87d1132',
);

$oauth_consumer_secret = array(
    'oauth_token' => '58c19bb2b6f3b75104fdc8e7b86362370599649b6',
    'oauth_secret' => 'c915c06d7fd5decabe85592d142d1476'
);



//$http_url = "http://test.zzz.secure.ids111.com:97/sns/account";

$http_url = "http://kor-olsecure.ldoverseas.com/sns/account";

$Fetch_request = new Fetch_request_token();

$time = time();
//$headers = array(
//    'Authorization' => 'OAuth oauth_consumer_key="' . $oauth_secret_key['oauth_consumer_key'] .
//        '", oauth_token="' . $oauth_consumer_secret['oauth_token'] .
//        '", oauth_signature_method="HMAC-SHA1",oauth_timestamp="' . $time .
//        '", oauth_nonce="-4076884019643538433", oauth_version="1.0"');
//
//$headers = array(
//    'Authorization' => 'OAuth oauth_consumer_key="' . $oauth_secret_key['oauth_consumer_key'] .
//        '", oauth_token="' . $oauth_consumer_secret['oauth_token'] .
//        '", oauth_signature_method="HMAC-SHA1",oauth_timestamp="' . 1501228212 .
//        '", oauth_nonce="8680974834085608408", oauth_version="1.0"');

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

//var_dump($head_test_str);
$head_test_str = 'OAuth ' . $head_test_str;
$head_test_str = substr($head_test_str, 0, -1);

//var_dump($head_test_str);

$headers = array(
    'Authorization' => $head_test_str
);


$param_header = $Fetch_request->get_parameter_header($headers);

$http_method = 'POST';

$params = array();


$base_string = $Fetch_request->base_string($http_method, $http_url, $param_header, $params);


$OAuthSignature = new OAuthSignatures($oauth_secret_key['oauth_consumer_secret'], $oauth_consumer_secret['oauth_secret']);


$rre = $OAuthSignature->hashsign($base_string);

var_dump(urlencode($rre));


print 'Authorization: ' . $headers['Authorization'] . ',oauth_signature="' . urlencode($rre) . '",oauth_signature_v2="' . urlencode($rre) . '"';
