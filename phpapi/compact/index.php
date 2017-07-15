<?php
/**
 * compact — 建立一个数组，包括变量名和它们的值
 *
 * array compact ( mixed $varname1 [, mixed $... ] )
 *
 * 创建一个包含变量与其值的数组。
 *
 * 对每个参数，compact() 在当前的符号表中查找该变量名并将它添加到输出的数组中，变量名成为键名而变量的内容成为该键的值。
 * 简单说，它做的事和 extract() 正好相反。
 * 返回将所有变量添加进去后的数组。
 *
 * 任何没有变量名与之对应的字符串都被略过。
 *
 * 参数
 *
 * varname1
 * compact() 接受可变的参数数目。每个参数可以是一个包括变量名的字符串或者是一个包含变量名的数组，该数组中还可以包含其它单元内容为变量名的数组， compact() 可以递归处理。
 *
 * 返回值
 *
 * 返回输出的数组，包含了添加的所有变量。
 *
 */

$name = 'saki';
$age = 23;
$sex = 1;

$info = array(
    'point' => 34234,
    'level' => 13
);

$fields = array('name', 'age');

$arr = compact($fields, 'point', 'sex', 'info');

var_dump($arr);