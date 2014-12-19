<?php

function createAccount($account,$password,$name){
	$time = date('Y-m-d H:i:s',time());
	$code = md5($account . '500efuma' . $time);
	$pwd = md5($password . '500efuma');
	
	$data['code'] = $code;
	$data['account'] = $account;
	$data['password'] = $pwd;
	$data['name'] = $name;
	$data['ctm'] = $time;
	return $data;
}


$data = createAccount('saki', 'q584521816!', '大魔王');
var_dump($data);


