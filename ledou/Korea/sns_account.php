<?php
include 'auth/Auth.php';

$oauth_secret_key = array(
    'oauth_consumer_key'=>'0bb9be981116a83534b7',
    'oauth_consumer_secret'=>'2c2cce5b87e6364d4cb7',
);

$oauth_consumer_secret = array(
    'oauth_token'=>'82c8b1d72f37fe71ef5ba7ce33641fe20593f5b87',
    'oauth_secret'=>'17fcac6f0ec80d00ae9f45b9304425a7'
);



//$http_url = "http://test.zzz.secure.ids111.com:96/sns/account";

$http_url = "http://usa-sb-secure.ldoverseas.com/sns/account";


$Fetch_request=new Fetch_request_token();


$time =time();
$headers=array('Authorization'=>'OAuth oauth_consumer_key="'.$oauth_secret_key['oauth_consumer_key'].'", oauth_token="'.$oauth_consumer_secret['oauth_token'].'", oauth_signature_method="HMAC-SHA1",oauth_timestamp="'.$time.'", oauth_nonce="-4076884019643538433", oauth_version="1.0"');

$param_header=$Fetch_request->get_parameter_header($headers);

$http_method = 'POST';

$params=array();


$base_string=$Fetch_request->base_string($http_method,$http_url,$param_header,$params);


$OAuthSignature=new OAuthSignatures($oauth_secret_key['oauth_consumer_secret'],$oauth_consumer_secret['oauth_secret']);


$rre=$OAuthSignature->hashsign($base_string);

var_dump(urlencode($rre));


print 'Authorization: '.$headers['Authorization'].',oauth_signature="'.urlencode($rre).'",oauth_signature_v2="'.urlencode($rre).'"';
