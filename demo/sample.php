<?php
include_once "phprpc/phprpc_client.php";
$client = new PHPRPC_Client ( 'http://61.145.163.80/biz/interface/xyDataApi.php' );



/*接收微信活动*/
// $arr = array(
// 	'actname' => 'test1',
// 	'actstart' => '2014-08-28 00:00:00',
// 	'actend' => '2014-08-29 00:00:00',
// 	'actgiftnums' => 10
// );
// $json = $client->acceptWxActivity( 'XY001JZ', '350001', $arr );
// $res = json_decode($json);
// var_dump($res);



/*获取达到消费条件的会员列表*/
$arr = array(
	'startnum' => 10001,
	'startdate' => '2014-08-16',
	'enddate' => '2014-09-01',
// 	'minamount' => 0,
// 	'maxamount' => 1000,
	'constimes' => 1,
);
$json = $client->getConsCusList( 'XY001JZ', '350001', $arr );
echo $json;
$res = json_decode($json);
var_dump($res);














?>