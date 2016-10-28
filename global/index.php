<?php




function print_point()
{
    $GLOBALS["point"]++;
    echo $GLOBALS["point"];

}

function add()
{
    global $point;
    $point++;
}

$point = 100;

print_point();
//add();
//print_point();
