<?php
include 'auth/Auth.php';

$game_key_secret = array(
    'key' => '67a671523a3b098cf561',
    'secret' => '6422592d6968c87d1132'
);

$token_key_secret = array(
    'key' => '',
    'secret' => ''
);


$Fetch_request = new Fetch_request_token();

$param_header = array(
    'oauth_consumer_key' => $game_key_secret['key'],
//    'oauth_token'            => $token_key_secret['key'],
    'oauth_signature_method' => 'HMAC-SHA1',
    'oauth_timestamp' => (string)time(),
    'oauth_nonce' => '58E27606-FA79-4A52-BB44-4E376CC0C624',
    'oauth_version' => '1.0',
    'oauth_callback' => 'dgc-request-token-callback',
);


//测试地址
$host = "http://test.zzz.secure.ids111.com:97";

//线上地址
//$host = "http://kor-olsecure.ldoverseas.com";


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



//echo '<br><br>'."//***************************************************************************************//" . '<br><br>';

//***************************************************************************************//


//$oauth_secret_key = array(
//    'oauth_consumer_key'=>'05256a1728db60b36fd2',
//    'oauth_consumer_secret'=>'f3221b8477864bb80727',
//);
//
//$oauth_consumer_secret = array(
//    'oauth_token'=>'',
//    'oauth_secret'=>''
//);
//
//
//$api = "http://test.zzz.secure.ids111.com:97";
//
//$url = "/oauth/request_token";
//
//$Fetch_request=new Fetch_request_token();
//
//
//$time = time();
//$headers=array('Authorization'=>'OAuth oauth_consumer_key="'.$oauth_secret_key['oauth_consumer_key'].'",  oauth_signature_method="HMAC-SHA1",oauth_timestamp="'.$time.'", oauth_nonce="-4076884019643538433", oauth_version="1.0",oauth_callback="dgc-request-token-callback"');
//
//
//$param_header=$Fetch_request->get_parameter_header($headers);
//
//$http_method = 'POST';
//$http_url = $api.$url;
//$params=array();
//
//
//$base_string=$Fetch_request->base_string($http_method,$http_url,$param_header,$params);
//echo "</br>".urldecode($base_string)."</br>";
//
//
//$OAuthSignature = new OAuthSignatures($oauth_secret_key['oauth_consumer_secret'],$oauth_consumer_secret['oauth_secret']);
//
//
//$rre=$OAuthSignature->hashsign($base_string);
//
//var_dump($rre);
//
//print 'Authorization: '.$headers['Authorization'].',oauth_signature="'.urlencode($rre).'",oauth_signature_v2="'.urlencode($rre).'"';


