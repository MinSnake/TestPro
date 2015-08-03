<?php
// function getMillisecond() {
// list($t1, $t2) = explode(' ', microtime());     
// return (float)sprintf('%.0f', (floatval($t1) + floatval($t2)) * 1000);  
// }
// echo getMillisecond();
// echo '<br>';
// echo time();
// echo '<br>';
// echo microtime();

// echo "<style>
//     .a{
//     font-family:'Letter Game Tiles';
// }
// </style>";
// echo '<h1 class="a">500e</h1>';
// echo '<h1 class="a">FUMA</h1>';

$email = '395408934@qq.com';
$reg = "/^([a-zA-Z0-9_-])+@([a-zA-Z0-9_-])+(.[a-zA-Z0-9_-])+/";
$a = preg_match($reg, $email);
var_dump($a);
