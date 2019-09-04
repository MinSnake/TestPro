<?php
//$fp = fopen('tlbb.txt', 'r');
//$line = 5;
//$pos = -2;
//$ch = '';
//$content = '';
//while ($line > 0) {
//    while ($ch != "\n") {
//        fseek($fp, $pos, SEEK_END);
//        $ch = fgetc($fp);
//        $pos--;
//    }
//    $ch = '';
//    $content .= fgets($fp);
//    $line--;
//}
//echo $content;
$times = 1;
while (true) {
    echo $times . PHP_EOL;
    $times++;
    sleep(1);
}