<?php
include 'auth/Auth.php';

$oauth_secret_key = array(
    'oauth_consumer_key'=>'05256a1728db60b36fd2',
    'oauth_consumer_secret'=>'f3221b8477864bb80727',
);

$oauth_consumer_secret = array(
    'oauth_token'=>'f68ce3ee2fb0024420c23963dc80fb600597565b5',
    'oauth_secret'=>'09eefe3eb51ed1993be61189e6e39d69'
);


$api = "http://test.zzz.secure.ids111.com:97";

$url = "/oauth/access_token";


$Fetch_request=new Fetch_request_token();

$time =time();

$headers=array('Authorization'=>'OAuth oauth_consumer_key="'.$oauth_secret_key['oauth_consumer_key'].'", oauth_token="'.$oauth_consumer_secret['oauth_token'].'", oauth_signature_method="HMAC-SHA1",oauth_timestamp="'.$time.'", oauth_nonce="-4076884019643538433", oauth_version="1.0"');



//$headers=array('Authorization'=>'OAuth oauth_consumer_key="0bb9be981116a83534b7", oauth_signature_method="HMAC-SHA1", oauth_signature="OZGlpF5Ea2yxLVJUn%2BRD26sZqNY%3D", oauth_timestamp="1476965508", oauth_nonce="9124907849001251709", oauth_version="1.0", oauth_callback="dgc-request-token-callback", oauth_signature_v2="de1eK9yGa8cYdd%2BBbACAGfTXyGI%3D"');

$param_header=$Fetch_request->get_parameter_header($headers);

$http_method = 'POST';
$http_url = $api.$url;
$params=array();


$base_string=$Fetch_request->base_string($http_method,$http_url,$param_header,$params);


$OAuthSignature=new OAuthSignatures($oauth_secret_key['oauth_consumer_secret'],$oauth_consumer_secret['oauth_secret']);


$rre=$OAuthSignature->hashsign($base_string);

var_dump(urlencode($rre));


print 'Authorization: '.$headers['Authorization'].',oauth_signature="'.urlencode($rre).'"';




