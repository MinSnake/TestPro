<?php
$a = 1;
function test(){
	global $a;
	$a = 123;
}
test();
echo $a;