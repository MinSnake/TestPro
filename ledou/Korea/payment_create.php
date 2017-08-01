<?php
include 'auth/Auth.php';


$oauth_secret_key = array(
    'oauth_consumer_key' => '67a671523a3b098cf561',
    'oauth_consumer_secret' => '6422592d6968c87d1132',
);

$oauth_consumer_secret = array(
    'oauth_token' => 'e7ad477e7e1b36daec225938c0c219c70597856e5',
    'oauth_secret' => '7fdbcc8b91b05c54d4d935607fc259f7'
);



$http_url = "http://payv2.dev.ids111.com:97/payments/create";
//$http_url = "http://usa-olpay.ldoverseas.com/payments/create";
//$http_url = "http://usa-sb-pay.ldoverseas.com/payments/create";


$Fetch_request=new Fetch_request_token();




//$headers=array('Authorization'=>'OAuth oauth_consumer_key="aedfcadbe6197479fc7b", oauth_token="1fe581fa17d34de77ba6234c4a3baa380592e8969", oauth_signature_method="HMAC-SHA1", oauth_signature="4A6IlG4I%2F8i3FTQbOpIC9d1TScw%3D", oauth_timestamp="1496226379", oauth_nonce="3696176625062964978", oauth_version="1.0", oauth_signature_v2="Qtyzn0wYnJ6PDIXn%2F1v%2BinuTBLo%3D"');

$time=time();

$headers=array('Authorization'=>'OAuth oauth_consumer_key="'.$oauth_secret_key['oauth_consumer_key'].'", oauth_token="'.$oauth_consumer_secret['oauth_token'].'", oauth_signature_method="HMAC-SHA1",oauth_timestamp="'.$time.'", oauth_nonce="-4076884019643538433", oauth_version="1.0"');

//$headers=array('Authorization'=>'OAuth oauth_consumer_key="'.$oauth_secret_key['oauth_consumer_key'].'", oauth_token="'.$oauth_consumer_secret['oauth_token'].'", oauth_signature_method="HMAC-SHA1", oauth_timestamp="1497513304", oauth_nonce="-5334985442199657064", oauth_version="1.0"');

//$headers=array('Authorization'=>'OAuth oauth_nonce="-4075284676410397535", oauth_token="7eab5e1db85d9be2c158e2230fc9ad180595649f1", oauth_consumer_key="0bb9be981116a83534b7", oauth_signature_method="HMAC-SHA1", oauth_timestamp="1498827237", oauth_version="1.0"');



$param_header=$Fetch_request->get_parameter_header($headers);

$http_method = 'POST';

//$json='{"product_id":"2511422445551","product_name":"金币","p_identifier":"test1","quantity":"1","auth_game_type":1,"paymethod":"64","currency":"TWD","order_amount":"6","type":8,"extral_info":"string","price":"2.0","channel_id":"NT0S0N00002","server_id":"1","cli_ver":"pay-3.2.2.57","imei":"864230031942103","nudid":"83q1q11n1_322911905487308411r854","udid":"00000000-439c-a1d4-ffff-ffff8c78a45e"}';


//$params=json_decode($json,true);
// $params = array ( 
// 'product_id' => '7652', 
// 'discount' => '1.0', 
// 'recharge' => '2.0', 
// 'server_id' => NULL, 
// 'paymethod' => '64', 
// 'currency' => 'TWD',
// 'order_amount'=>'6',
// 'extral_info' => NULL, 
// 'auth_game_type' => '2', 
// 'quantity' => 1, 
// 'price' => '2.0',
// 'product_name'=>'金币',
// 'nudid' => '83q1q11n1_3229119054873088411r854', 
// 'channel_id' => 'NT0S0N00002',
// 'product_id' =>2511422445551,
// 'udid' => '00000000-439c-a1d4-ffff-ffff8c78a45e', 
// 'cli_ver' => 'pay-3.2.2.57', 
// 'type' => '8', );

$params = array (
    "product_id"=>"2511422445551",
    "product_name"=>"金币",
    "p_identifier"=>"test1",
    "quantity"=>"1",
    "auth_game_type"=>1,
    "paymethod"=>"64",
    "currency"=>"TWD",
    "order_amount"=>"6",
    "type"=>8,
    "extral_info"=>"string",
    "price"=>"2.0",
    "channel_id"=>"NT0S0N00002",
    "server_id"=>"1",
    "cli_ver"=>"pay-3.2.2.57",
    "imei"=>"864230031942103",
    "nudid"=>"TEST498f0723-570c-4bbc-88ea-10000000003",
    "udid"=>"TEST498f0723-570c-4bbc-88ea-10000000003"
);


// $params = array(
//     "auth_game_type"=>"1",
//     "channel_id"=>"TEST",
//     "cli_ver"=>"1.0.0.0",
//     "currency"=>"USD",
//     "extral_info"=>"1",
//     "imei"=>"111111",
//     "nudid"=>"642sos_555555555575330r44886q7",
//     "order_amount"=>"1",
//     "p_identifier"=>"com.idream.android.googleplaytest.product1",
//     "paymethod"=>"156",
//     "price"=>"1",
//     "product_id"=>"com.idream.android.googleplaytest.product1",
//     "product_name"=>"测试道具",
//     "quantity"=>"1",
//     "server_id"=>"1",
//     "type"=>"1",
//     "udid"=>"ffffffff-b9ee-d703-0000-000000000000",
// );



var_dump(var_export(json_encode($params),true));


$base_string=$Fetch_request->base_string($http_method,$http_url,$param_header);

$base_string2=$Fetch_request->base_string($http_method,$http_url,$param_header,$params);


$OAuthSignature=new OAuthSignatures($oauth_secret_key['oauth_consumer_secret'],$oauth_consumer_secret['oauth_secret']);


$rre=$OAuthSignature->hashsign($base_string);
$rres=$OAuthSignature->hashsign($base_string2);

var_dump(urlencode($rre));
var_dump(urlencode($rres));


print 'Authorization: '.$headers['Authorization'].',oauth_signature="'.urlencode($rre).'",oauth_signature_v2="'.urlencode($rres).'"';




