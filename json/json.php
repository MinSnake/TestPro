<?php
//配置菜单
$menu_1['name'] = '频道';
$menu_1['type'] = 'view';
$menu_1['url'] = 'http://saki.sinaapp.com/';

$menu_2['name'] = '内容';
$menu_2['type'] = 'view';
$menu_2['url'] = 'http://acgdb.com/';


$menu_3_1['type'] = 'view';
$menu_3_1['name'] = '获取幻灯片信息';
$menu_3_1['url'] = 'http://bibi.500efuma.com/';

$menu_3_2['type'] = 'view';
$menu_3_2['name'] = '获取幻灯片信息';
$menu_3_2['url'] = 'http://bibi.500efuma.com/';

$temp = array();
array_push($temp,$menu_3_1,$menu_3_2);

$menu_3['name'] = '幻灯片';
$menu_3['sub_button'] = $temp;

$data = array();
array_push($data,$menu_1,$menu_2,$menu_3);

$res = array();
$res['button'] = $data;

var_dump($res);
echo json_encode($res,JSON_UNESCAPED_UNICODE);

var_dump($menu_3);

