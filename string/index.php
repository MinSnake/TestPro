<?php

/**
 *
OAuth token=bbf46b425b2d459f500e7c5d3460953d26c5992a&timestamp=1513934911595&sign=8d6a15acbe8dc53df1206e691344170b

 */
$token = '001d5fe70c5a8605cd4e0ff0964e3b566495858d';

echo '当前token:  ' . $token;

echo '<br><br>';

$now_time = time();
//$now_time = 1514553056944;
//$now_time = 0;

echo '当前时间戳:   ' . $now_time . '  --  ' . date('Y-m-d H:i:s' , $now_time);

echo '<br><br>';

$sign = md5($now_time . '&weplay&' . $token);

echo '当前时间生成的加密串:   ' . $sign;

//
//echo '<br><br>';
//echo '<br><br>';

//$seven_day_time = $now_time - 7 * 24 * 3600;

//echo '7天前的时间戳:   ' . $seven_day_time . '  --  ' . date('Y-m-d H:i:s' , $seven_day_time);

//echo '<br><br>';


//echo "<span style='font-size: 10px;color: #ef5e4d;'>烟火</span><span style='font-size: 10px;color: #999999;margin-left: 10px;margin-right: 10px;'> 给 </span><span style='font-size: 10px;color: #ef5e4d;'>ULD9224850668</span><span style='font-size: 10px;color: #999999;margin-left: 10px;margin-right: 10px;'> 赠送了 </span><span style='font-size: 10px;color: #ef5e4d;'>海洋之心x1</span>";