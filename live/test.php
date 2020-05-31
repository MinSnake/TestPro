<?php

$webContent = file_get_contents("https://m.douyu.com/7790392");
$pattern = "/\"hn\":\"(\d+[.]?\d+万|\d+)\"/";
preg_match_all($pattern, $webContent, $pat_array);
//var_dump($pat_array);
echo $pat_array[1][0];