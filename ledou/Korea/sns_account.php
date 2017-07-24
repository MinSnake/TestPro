<?php
include 'auth/Auth.php';

$oauth_secret_key = array(
    'oauth_consumer_key'=>'05256a1728db60b36fd2',
    'oauth_consumer_secret'=>'f3221b8477864bb80727',
);

$oauth_consumer_secret = array(
    'oauth_token'=>'4550653b23a2bb8d205f5e10eaf0a3180597161ba',
    'oauth_secret'=>'87127df004ef1de9f9109a05e23d9a22'
);



//$http_url = "http://test.zzz.secure.ids111.com:96/sns/account";

//$http_url = "http://usa-sb-secure.ldoverseas.com/sns/account";

$http_url = "http://test.zzz.secure.ids111.com:97/sns/account";

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
