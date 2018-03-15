<?php
//中英文混合昵称，最大支持24个字节
$name = '我ad$算bas大0声道中csd打算c文dsad啊efght你是mn中文';

function cut_name($name, $temp_name, $maxlen = 24, $encoding = 'UTF-8', $i = 1)
{
    echo '---------------------------------------------' . PHP_EOL;
    $mb_name_len = strlen($temp_name);
    if ($mb_name_len > $maxlen) {
        echo '当前字符串: ' . $temp_name . PHP_EOL;
        echo '发现字节长度大于24，当前长度：' . $mb_name_len . PHP_EOL;
        $cut_len = mb_strlen($name, $encoding) - $i;
        echo '即将截取长度：' . $cut_len . PHP_EOL;
        $temp_name = mb_substr($temp_name, 0, $cut_len, $encoding);
        echo $temp_name . PHP_EOL;
        $i++;
        return cut_name($name, $temp_name, $maxlen, $encoding, $i);
    } else {
        return $temp_name;
    }
}

//$cut_name = cut_name($name, $name);
//echo '=============================================' . PHP_EOL;
//echo '最终截取结果: ' . $cut_name . PHP_EOL;
//echo '最终字节长度：' . strlen($cut_name) . PHP_EOL;


if (empty(1))
{
    echo 'ok' . PHP_EOL;
}
else{
    echo 'no' . PHP_EOL;
}