<?php
include 'auth/Auth.php';


// $http_url = "http://sb-olfeed.idealgame.com.tw/sns/getFriendList";

// $oauth_secret_key = array(
//     'oauth_consumer_key'=>'67a671523a3b098cf561',
//     'oauth_consumer_secret'=>'6422592d6968c87d1132',
// );

// $oauth_consumer_secret = array(
//     'oauth_token'=>'3b873839401392c1c017b1d98d0a6bbc05947a27d',
//     'oauth_secret'=>'a6b8cd24ef4c3415d18605b3b474e05a'
// );

$oauth_secret_key = array(
    'oauth_consumer_key'=>'0bb9be981116a83534b7',
    'oauth_consumer_secret'=>'2c2cce5b87e6364d4cb7',
);

$oauth_consumer_secret = array(
    'oauth_token'=>'b3daf4de0140bcf88213aff39193f7f90596862af',
    'oauth_secret'=>'a9e4f90aad40b9fd80c1b6dbeb2683b0'
);





//$http_url = "http://usa-olfeed.ldoverseas.com/account/verify_credentials";//?init=1&sdk_version=2.0&udid=00000000-60b2-e740-eb18-8bf30033c587&game_version=3.2.8&nudid=22826oos9396440_5085204153orp72r9&channel_id=LE0S0N30000";

//$http_url = "http://usa-sb-feed.ldoverseas.com/account/verify_credentials";

$http_url = "http://test.zzz.feed.ids111.com:97/account/verify_credentials";

$Fetch_request=new Fetch_request_token();


$time =time();

//$headers=array('Authorization'=>'OAuth oauth_consumer_key="0bb9be981116a83534b7", oauth_token="6368feb43ecc532271494017766acac5059278894", oauth_signature_method="HMAC-SHA1", oauth_signature="3Z6AoZAPuWF20cOX4v%2FQNJbuchQ%3D", oauth_timestamp="1472438988", oauth_nonce="-5088990226636127275", oauth_version="1.0", oauth_signature_v2="1GXEXEcMS7N51ZYl14NEcf%2BjHNY%3D"');
$headers=array('Authorization'=>'OAuth oauth_consumer_key="'.$oauth_secret_key['oauth_consumer_key'].'", oauth_token="'.$oauth_consumer_secret['oauth_token'].'", oauth_signature_method="HMAC-SHA1",oauth_timestamp="'.$time.'", oauth_nonce="-4076884019643538433", oauth_version="1.0"');



$param_header=$Fetch_request->get_parameter_header($headers);

$http_method = 'GET';

$params=array();


$base_string=$Fetch_request->base_string($http_method,$http_url,$param_header,$params);


$OAuthSignature=new OAuthSignatures($oauth_secret_key['oauth_consumer_secret'],$oauth_consumer_secret['oauth_secret']);


$rre=$OAuthSignature->hashsign($base_string);

var_dump(urlencode($rre));


print 'Authorization: '.$headers['Authorization'].',oauth_signature="'.urlencode($rre).'",oauth_signature_v2="'.urlencode($rre).'"';




