<?php
include 'auth/Auth.php';

$oauth_secret_key = array(
    'oauth_consumer_key' => '67a671523a3b098cf561',
    'oauth_consumer_secret' => '6422592d6968c87d1132',
);

$oauth_consumer_secret = array(
    'oauth_token' => 'ecc6820aabd79341817372ff2268faea0597aeadc',
    'oauth_secret' => 'db4a0114be901c6555c1aec1331489c8'
);


$oauth_secret_key = array(
    'oauth_consumer_key' => '67a671523a3b098cf561',
    'oauth_consumer_secret' => '6422592d6968c87d1132',
);

$oauth_consumer_secret = array(
    'oauth_token' => 'e671f81872c67d428d601f72623bd9bc0597aecae',
    'oauth_secret' => 'db4a0114be901c6555c1aec1331489c8'
);




//$http_url = "http://test.zzz.secure.ids111.com:96/sns/account";

//$http_url = "http://usa-sb-secure.ldoverseas.com/sns/account";

$http_url = "http://test.zzz.secure.ids111.com:97/sns/account";

$Fetch_request=new Fetch_request_token();


$time =time();
$headers = array(
    'Authorization'=>'OAuth oauth_consumer_key="'.$oauth_secret_key['oauth_consumer_key'].
        '", oauth_token="'.$oauth_consumer_secret['oauth_token'].
        '", oauth_signature_method="HMAC-SHA1",oauth_timestamp="'.$time.
        '", oauth_nonce="-4076884019643538433", oauth_version="1.0"');

$headers = array(
    'Authorization'=>'OAuth oauth_consumer_key="'.$oauth_secret_key['oauth_consumer_key'].
        '", oauth_token="'.$oauth_consumer_secret['oauth_token'].
        '", oauth_signature_method="HMAC-SHA1",oauth_timestamp="'. 1501228212 .
        '", oauth_nonce="8680974834085608408", oauth_version="1.0"');

$param_header=$Fetch_request->get_parameter_header($headers);

$http_method = 'POST';

$params=array();


$base_string=$Fetch_request->base_string($http_method,$http_url,$param_header,$params);


$OAuthSignature=new OAuthSignatures($oauth_secret_key['oauth_consumer_secret'],$oauth_consumer_secret['oauth_secret']);


$rre=$OAuthSignature->hashsign($base_string);

var_dump(urlencode($rre));


print 'Authorization: '.$headers['Authorization'].',oauth_signature="'.urlencode($rre).'",oauth_signature_v2="'.urlencode($rre).'"';