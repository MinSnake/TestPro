<?php
include_once "phprpc/phprpc_client.php";
$client = new PHPRPC_Client ( 'http://113.108.103.231:8008/biz/interface/xyDataApi.php' );
$account = 'XY001JZ';
$password = '350001';
$cusId = 5669802;


// $point = $client->getCusPoints( $account, $password, $cusId );
// $pointObj = json_decode ($point);
// var_dump($pointObj);






?>