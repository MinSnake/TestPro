<?php

/**
 * @todo 从M个数字中选N个数字的不重复组合
 *
 * @param $index
 * @param $m
 * @param $n
 * @param $temp_arr
 * @param $result
 * @return mixed
 */
function c($index, $m, $n, $temp_arr = array(), $result = array())
{
    if ($n == 1) {
        for ($i = $index; $i < count($m); $i++) {
            array_push($temp_arr, $m[$i]);
            array_push($result, $temp_arr);
            array_pop($temp_arr);
        }
        return $result;
    } elseif ($n > 1) {
        for ($i = $index; $i < count($m); $i++) {
            array_push($temp_arr, $m[$i]);
            $result = c($i + 1, $m, $n - 1, $temp_arr, $result);
            array_pop($temp_arr);
        }
        return $result;
    } else {
        die("error");
    }
}


$m = [1, 2, 3, 4];

$n = 2;

$r = c(0, $m, $n);

var_dump($r);









