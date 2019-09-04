<?php
function tail($fp, $n, $base = 2)
{
    assert($n > 0);
    $pos = $n + 1;
    $lines = array();
    while (count($lines) <= $n) {
        try {
            fseek($fp, -$pos, SEEK_END);
        } catch (Exception $e) {
            fseek($fp, 0);
            break;
        }
        $pos *= $base;
        while (!feof($fp)) {
            array_unshift($lines, fgets($fp));
        }
    }

    return array_slice($lines, 0, $n);
}

$fp = fopen("test.txt", "r+");
var_dump(tail($fp, 10));