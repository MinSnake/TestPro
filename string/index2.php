<?php

//$input = '1234567890-=~!@#$%^&*()_+ 123456~`&**)(_+0000';
//
////urlencode_rfc3986
//echo 'urlencode_rfc3986:' . PHP_EOL;
//echo str_replace(
//    '+',
//    ' ',
//    str_replace('%7E', '~', rawurlencode($input))
//) . PHP_EOL;
//
//echo 'urldecode_rfc3986:' . PHP_EOL;
////urldecode_rfc3986
//echo urlencode($input) . PHP_EOL;

$s = 'POST&http://test.zzz.in1.feed.ids111.com/fortumo/payinfo&' . 'oauth_consumer_key=8fee977f5ba1244dc4f1&oauth_nonce=58E27606-FA79-4A52-BB44-4E376CC0C624&oauth_signature_method=HMAC-SHA1&oauth_timestamp=1505721900&oauth_version=1.0';


echo $s;


echo '<br>';

echo urlencode($s);
