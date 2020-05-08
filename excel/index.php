<?php

use PhpOffice\PhpSpreadsheet\IOFactory;

require_once "vendor/autoload.php";

$file = dirname(__FILE__) . "/data.xlsx";

$spreadsheet = IOFactory::load($file);

$s1 = $spreadsheet->getSheet(0)->toArray();
$s2 = $spreadsheet->getSheet(1)->toArray();


foreach ($s1 as $m=>$info1) {
    $nameA = $info1[1];
    $moneyA = $info1[2];
    foreach ($s2 as $n=>$info2) {
        $nameB = $info2[1];
        $moneyB = $info2[2];
        if ($nameA === $nameB && $moneyA !== $moneyB) {
            echo $nameA . ": sheet1 - " . $moneyA . ",  sheet2 - " . $moneyB . PHP_EOL;
//            echo "查找到表2中的名称：" . $nameA;
//            echo ($m + 1) . ":" . $nameA . "-" . $moneyA . PHP_EOL;
        }
    }
}

