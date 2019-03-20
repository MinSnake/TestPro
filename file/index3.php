<?php
//$file_path = 'tlbb.txt';
//$filesize = filesize($file_path);
//echo '当前文件大小为： ' . round($filesize / 1024 / 1024, 2) . 'M' . PHP_EOL;
//$begin = microtime(true);
//
//
//$fp = fopen($file_path, 'r');
//$count = 0;
//$findstr = "岂有此理";
//while (!feof($fp)) {
//    $temp = fread($fp, 20240);
//    $pos = substr_count($temp, $findstr);
//    if ($pos) {
//        $count += $pos;
//    }
//}
//
//fclose($fp);
//
//echo "[$findstr]出现了" . $count . "次" . PHP_EOL;
//
//$end = microtime(true);
//echo "总耗时：" . ($end - $begin) . PHP_EOL;

$fp = fopen('test.txt', 'r');
//$fp = fopen('tlbb-s.txt', 'r');
//$fp = fopen('tlbb.txt', 'r');
$begin = microtime(true);
$start = 0;
$length = 6;

$line = 2;

while ($line > 0) {
//    while (!feof($fp)) {
        fseek($fp, -2, SEEK_END);
        $t = fgetc($fp);
        echo $t;
//        $line--;
//    }
}


fclose($fp);
$end = microtime(true);
echo "总耗时：" . ($end - $begin) . PHP_EOL;

