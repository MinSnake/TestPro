<?php

use PhpOffice\PhpSpreadsheet\IOFactory;

require_once "vendor/autoload.php";

$file = dirname(__FILE__) . "/data.xlsx";

$spreadsheet = IOFactory::load($file);

$s1 = $spreadsheet->getSheet(2)->toArray();
$s2 = $spreadsheet->getSheet(3)->toArray();

$newS1 = [];
$newS2 = [];
foreach ($s1 as $info1) {
    $nameA = $info1[1];
    $moneyA = $info1[2];
    array_push($newS1, [$nameA => $moneyA]);
}
foreach ($s2 as $info2) {
    $nameB = $info2[1];
    $moneyB = $info2[2];
    array_push($newS2, [$nameB => $moneyB]);
}

//foreach ($s1 as $m=>$info1) {
//    $nameA = $info1[1];
//    $moneyA = $info1[2];
//    foreach ($s2 as $n=>$info2) {
//        $nameB = $info2[1];
//        $moneyB = $info2[2];
//        if ($nameA === $nameB && $moneyA !== $moneyB) {
//            echo $nameA . ": sheet1 - " . $moneyA . ",  sheet2 - " . $moneyB . PHP_EOL;
//        }
//    }
//}
var_dump($newS1);
//var_dump($newS2);
//$x = array_diff_assoc($newS2, $newS1);
//$y = array_diff_assoc($newS1, $newS2);
//$z = array_merge($x, $y);
//var_dump($z);
//foreach ($res as $re) {
//    echo var_export($re, true) . PHP_EOL;
//}
//var_export($res);


//$a1=array("a"=>"red","b"=>"green","c"=>"blue","d"=>"yellow");
//$a2=array("a"=>"red","b"=>"green","c"=>"blue");
//$a1 = array(1,2,3);
//$a2 = array(1,4,5);
//$result=array_diff_assoc($a1,$a2);
//print_r($result);