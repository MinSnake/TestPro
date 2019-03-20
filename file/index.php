<?php
$file_path = 'tlbb.txt';
$file_temp_path = 'temp.txt';
if (file_exists($file_path)) {
    $filesize = filesize($file_path);
    echo '当前文件大小为： ' . round($filesize / 1024 / 1024, 2) . 'M' . PHP_EOL;
    $begin = microtime(true);

    //读取文件到临时文件中
    $fp = fopen($file_path, 'r');
//    $fpw_temp = fopen($file_temp_path, 'w+');
    while (!feof($fp)) {
        $temp = fread($fp, 10240);
        echo $temp;
        sleep(1);
//        fwrite($fpw_temp, $temp);
    }

//    fclose($fpw_temp);
    fclose($fp);

    //将临时文件中的内容加载到源文件中
//    $fpr_temp = fopen($file_temp_path, 'r');
//    $fpw_old = fopen($file_path, 'a+');
//    fwrite($fpw_old, "\n");
//    while (!feof($fpr_temp)) {
//        $temp = fread($fpr_temp, 4096);
//        fwrite($fpw_old, $temp);
//    }
//    fclose($fpr_temp);
//    fclose($fpw_old);

//    unlink($file_temp_path);

    $end = microtime(true);
    echo "总耗时：" . ($end - $begin) . PHP_EOL;
//    $filesize = filesize($file_path);
//    echo "最终文件大小：" . round($filesize / 1024 / 1024, 2) . 'M' . PHP_EOL;;

} else {
    echo 'file not exit';
}

