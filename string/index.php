<?php
//$mtime = explode(' ', microtime());
////取毫秒数小数点后6位
//$code = substr($mtime[0], 2, 4);
//echo $code;

$token = 'd5c61b36731068bb9bf61fcfdc369167ef505e76';

echo '当前token:  ' . $token;

echo '<br><br>';

$now_time = time();

echo '当前时间戳:   ' . $now_time . '  --  ' . date('Y-m-d H:i:s' , $now_time);

echo '<br><br>';

echo '当前时间生成的加密串:   ' . md5($now_time . '&weplay&' . $token);

echo '<br><br>';

$seven_day_time = $now_time - 7 * 24 * 3600;

echo '7天前的时间戳:   ' . $seven_day_time . '  --  ' . date('Y-m-d H:i:s' , $seven_day_time);


//echo strlen('汉');

//echo strtotime('1991-04-23');
//
//if (true === -1)
//{
//    echo '1';
//}
//else
//{
//    echo '2';
//}
//
//$str = sha1(uniqid(rand() . 'weplay', true));
//
//echo $str;
//
//echo '<br>';
//
//echo '长度：' . strlen($str);

//echo strlen(sha1(uniqid(rand(), true)));

//$base_string = 'sadasdasdasdasd';
//$temp_1 = hash_hmac('sha1', $base_string, '1231231231', true);

//echo $temp_1;