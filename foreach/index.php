<?php

$arr = array(1, 2, 3, 4, 5);


foreach ($arr as $k=>$v) {

    echo '------'.$v . '----' . PHP_EOL;
    if ($v == 1)
    {
        continue;
//        break;
    }
    echo $v . PHP_EOL;
}








