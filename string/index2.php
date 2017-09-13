<?php

$input = '1234567890-=~!@#$%^&*()_+ 123456~`&**)(_+0000';

//urlencode_rfc3986
echo 'urlencode_rfc3986:' . PHP_EOL;
echo str_replace(
    '+',
    ' ',
    str_replace('%7E', '~', rawurlencode($input))
) . PHP_EOL;

echo 'urldecode_rfc3986:' . PHP_EOL;
//urldecode_rfc3986
echo urlencode($input) . PHP_EOL;