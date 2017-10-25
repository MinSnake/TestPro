<?php

$a = array(
    'secret' => '43d264060b765cd93c',
);
printf(json_encode($a) . PHP_EOL);



//function urlencode_rfc3986($input)
//{
//    if (is_scalar($input))
//    {
//        return str_replace(
//            '+',
//            ' ',
//            str_replace('%7E', '~', rawurlencode($input))
//        );
//    }
//    exit('参数错误');
//}
//
//
//$http_method = 'POST';
//
//$http_url =  'http://test.zzz.secure.ids111.com:97/oauth/request_token';
//
//$param_header = array(
//    'oauth_consumer_key'     => '67a671523a3b098cf561',
//    'oauth_signature_method' => 'HMAC-SHA1',
//    'oauth_timestamp'        => 1502764514,
//    'oauth_nonce'            => '58E27606-FA79-4A52-BB44-4E376CC0C624',
//    'oauth_version'          => '1.0',
//);
//
//ksort($param_header);
//$param_str = '';
//foreach ($param_header as $key=>$value) {
//    $param_str .= $key . '=' . $value . '&';
//}
//$param_str = substr($param_str, 0, -1);
//
//
//$str = urlencode_rfc3986($http_method) . '&' . urlencode_rfc3986($http_url) . '&' . urlencode_rfc3986($param_str);
//
//echo $str;
//
//$game_key_secret = array(
//    'key' => '67a671523a3b098cf561',
//    'secret' => '6422592d6968c87d1132'
//);
//
//$key = '6422592d6968c87d1132' . '&' . '';
//
//$string = base64_encode(hash_hmac('sha1', $str, $key, true));
//
//echo '<br>';
//echo $string;


