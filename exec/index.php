<?php
// 获取某目录下所有文件、目录名（不包括子目录下文件、目录名）
$dir = "/Users/dipelta/Movies/Saki/Achiga";
$handler = opendir($dir);
while(($file = readdir($handler)) !== false) {
    if ($file !== "." && $file !== ".." && substr($file,0 ,1) == "[") {
        $files[] = $file ;
    }
}
closedir($handler);
foreach ($files as $file) {
//    echo $file . PHP_EOL;
    $temp = explode('.', $file);
    $name = $temp[0];
    $flag_name = substr($name,42,2);
    if ($flag_name === "OV") {
        $flag_name = "OVA";
    }
//    echo $flag_name . ".mp4" . PHP_EOL;
    if (!in_array($flag_name, array("01","02","03","04","05"))) {
        $s_dir = $dir . "/" . $file;
        $s_dir = str_replace(" ", "\ ",$s_dir);
        $s_dir = str_replace("[", "\[",$s_dir);
        $s_dir = str_replace("]", "\]",$s_dir);

        $to_dir = $dir . "/" .$flag_name . ".mp4";

        $command = "ffmpeg -i " . $s_dir . " " . $to_dir;
        echo $command . PHP_EOL;
        system($command);
    }
    echo "\n------------------------------------\n";
}


//$handler = opendir($dir);
//while (($filename = readdir($handler)) !== false)
//{
//    // 务必使用!==，防止目录下出现类似文件名“0”等情况
//    if ($filename !== "." && $filename !== "..")
//    {
//        $files[] = $filename ;
//    }
//}
//}
//closedir($handler);
//// 打印所有文件名
//foreach ($filens as $value) {
//    echo $value, PHP_EOL;
//}