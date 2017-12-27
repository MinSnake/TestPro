<?php

/**
 *
OAuth token=bbf46b425b2d459f500e7c5d3460953d26c5992a&timestamp=1513934911595&sign=8d6a15acbe8dc53df1206e691344170b

 */
$token = 'bbf46b425b2d459f500e7c5d3460953d26c5992a';

echo '当前token:  ' . $token;

echo '<br><br>';

$now_time = time() - 60 * 10;
//$now_time = 1513934911596;
//$now_time = 0;

echo '当前时间戳:   ' . $now_time . '  --  ' . date('Y-m-d H:i:s' , $now_time);

echo '<br><br>';

$sign = md5($now_time . '&weplay&' . $token);

echo '当前时间生成的加密串:   ' . $sign;


echo '<br><br>';

$seven_day_time = $now_time - 7 * 24 * 3600;

echo '7天前的时间戳:   ' . $seven_day_time . '  --  ' . date('Y-m-d H:i:s' , $seven_day_time);

echo '<br><br>';

echo '<span style="color: #ef5e4d;margin-right: 10px">想不出名字</span>给<span style="color: #ef5e4d;margin: 0 10px">VAVA兔</span>下了一单';

echo '<br><br>';

echo "<span style='font-size: 26px;color: #ef5e4d;margin-right: 10px'>Jimmy</span><span style='font-size: 26px;color: #999999;'>给</span><span style='font-size: 26px;color: #ef5e4d;margin: 0 10px'>ULD3962163725</span><span style='font-size: 26px;color: #999999;'>赠送了1个</span><span style='font-size: 26px;color: #999999;'>海洋之心</span>";
//echo date('Y-m-d H:i:s', 1513870350);

echo '<br><br>';
echo '<br><br>';


echo "<span style='font-size: 26px;color: #ef5e4d;margin-right: 10px'>荣耀＄特德</span><span style='font-size: 26px;color: #999999;'>给</span><span style='font-size: 26px;color: #ef5e4d;margin: 0 10px'>殇小辛84</span><span style='font-size: 26px;color: #999999;'>下了1单</span>";


echo '<br><br>';

echo "<span style='font-size: 10px;color: #ef5e4d;margin-right: 10px'>ULD131561502l</span><span style='font-size: 10px;color: #999999;'>给给给给给给给给给给给给给给给给给给给给给给给给给给给给给给给给给给给给给给给给给给给给给给给给给给给给给给给给给给给给给给给给给给给给给给给给</span><span style='font-size: 10px;color: #ef5e4d;margin: 0 10px'>berton.luo</span><span style='font-size: 10px;color: #999999;'>下了1单</span>";