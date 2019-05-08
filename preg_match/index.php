<?php

$p = isset($_GET['p']) ? $_GET['p'] : '';


//$a = preg_match('/^[a-zA-Z][a-zA-Z0-9_]+$/', $p);
$a = preg_match('/^[a-zA-Z0-9]+$/', $p);

//echo $a;

echo md5('123456');
echo '<br>';
echo md5('123123');

