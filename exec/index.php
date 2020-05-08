<?php
// 获取某目录下所有文件、目录名（不包括子目录下文件、目录名）
$dir = "/Users/dipelta/Movies/Saki/Achiga/xx";
$handler = opendir($dir);
$files = [];
while (($file = readdir($handler)) !== false) {
    if ($file !== "." && $file !== ".." && substr($file, 0, 1) == "[") {
        $files[] = $file;
    }
}
closedir($handler);
foreach ($files as $file) {
    $temp = explode('.', $file);
    $name = $temp[0];
    $flag_name = substr($name, 42, 2);
    if ($flag_name === "OV") {
        $flag_name = "OVA";
    }
    if (!in_array($flag_name, array("01", "02", "03", "04", "05"))) {
        $s_dir = $dir . "/" . $file;
        $s_dir = str_replace(" ", "\ ", $s_dir);
        $s_dir = str_replace("[", "\[", $s_dir);
        $s_dir = str_replace("]", "\]", $s_dir);
        $to_dir = $dir . "/" . $flag_name . ".mp4";
        $command = "ffmpeg -i " . $s_dir . " " . $to_dir;
        echo $command . PHP_EOL;
        system($command);
    }
    echo "\n------------------------------------\n";
}
