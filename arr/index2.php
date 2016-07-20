<?php

$temp = array();

for ($i=0; $i < 10; $i++) {
    $level = rand(1, 100);

    $temp[] = array(
        'fd' => 1,
        'data' => array(
            'id' => 1,
            'level' => $level,
            'event' => array(
                'level' => $level
            ),
            'data' => array()
        )
    );

}

//var_dump($temp);

$data = array(5,4,15,7,19,9,1,6,3,20,10,11,13,2);

//for ($i=0; $i<count($data); $i++){
//    $start = 0;
//    $end = $i - 1;
//    $mid = 0;
//
//}


function insertion_sort($arr) { //php的陣列視為基本型別，所以必須用傳參考才能修改原陣列
    for ($i = 1; $i < count($arr); $i++) {
        $temp = $arr[$i];
        for ($j = $i - 1; $j >= 0 && $arr[$j] > $temp; $j--)
            $arr[$j + 1] = $arr[$j];
        $arr[$j + 1] = $temp;
    }
    return $arr;
}

function insertion_sort2($arr) { //php的陣列視為基本型別，所以必須用傳參考才能修改原陣列
    for ($i = 1; $i < count($arr); $i++) {
        $temp = $arr[$i];
        for ($j = $i - 1; $j >= 0 && $arr[$j]['data']['level'] > $temp['data']['level']; $j--){
            $arr[$j + 1] = $arr[$j];
        }
        $arr[$j + 1] = $temp;
    }
    return $arr;
}


$res = insertion_sort2($temp);

var_dump($res);









