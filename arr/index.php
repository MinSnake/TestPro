<?php
//$a = array(3,5,7,8,9);
$a = array(1,3,0,2);

$num = 2;
$num_key = array_search($num, $a);

//var_dump($a);

array_splice($a, $num_key, 1);

//var_dump($a);


//function del_for_tid_from_pool($tid){
//}

$num = 0;
$num_key = array_search($num, $a);
array_splice($a, $num_key, 1);

//var_dump($a);

$tid = null;

if ($tid !== null){
    echo '存在';
}else{
    echo '不存在';
}

//$aaa = array(
//    -1 => 'a',
//    0 => 'b',
//    500 => 'c',
//);
//
//var_dump($aaa);
//
//echo $aaa[-1];

