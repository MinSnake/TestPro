<?php
$rommId = 3484;
$webContent = file_get_contents("https://www.douyu.com/" . $rommId);
//echo $webContent;
//获取直播源地址
$pattern = "/live\/\w{10,90}.flv/";
preg_match_all($pattern, $webContent, $pat_array);
//var_dump($pat_array);
$sourceUrl = $pat_array[0][0];
$res = explode("/", $sourceUrl);
$res = explode(".", $res[1]);
$res = explode("_", $res[0]);
$roomFlag = $res[0];
$url = "http://tx2play1.douyucdn.cn/live/" . $roomFlag . "_1024p.flv";
echo $url . PHP_EOL;
$command = '/Applications/IINA.app/Contents/MacOS/iina-cli "' . $url .'"';
echo $command;
//exec($command);
