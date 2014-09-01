<?php
include_once "phprpc/phprpc_client.php";
$client = new PHPRPC_Client ( 'http://61.145.163.80/biz/interface/xyDataApi.php' );




$arr = array(
	'actname' => 'test',
	'actstart' => '2014-8-28 00:00:00',
	'actend' => '2014-8-29 00:00:00',
	'actgiftnums' => 10
);
$json = $client->acceptWxActivity( 'XY001JZ', '350001', 18682161234 );
$res = json_decode($json);
var_dump($res);


?>