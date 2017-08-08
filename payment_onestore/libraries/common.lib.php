<?php
	Header("Access-Control-Allow-Origin: *");
	Header("Access-Control-Allow-Methods: POST");
	if ( $_SERVER['CONTENT_TYPE'] != "application/x-www-form-urlencoded; charset=UTF-8" )
	{
		Header("Content-Type: application/json;charset:utf-8");
	}
	
	ini_set('always_populate_raw_post_data', -1);
	$HTTP_RAW_POST_DATA = file_get_contents('php://input');
	if ( isset($HTTP_RAW_POST_DATA) )
	{
		$convFromRAW = true;
		$convFromRAW = $convFromRAW && is_array($_POST);
		$convFromRAW = $convFromRAW && count($_POST) < 1;
		$convFromRAW = $convFromRAW && is_string($HTTP_RAW_POST_DATA);
		$convFromRAW = $convFromRAW && strlen($HTTP_RAW_POST_DATA) > 0;
		$convFromRAW = $convFromRAW && in_array(php_sapi_name(), Array("cgi-fcgi", "fpm-fcgi"));
		if ($convFromRAW) 
		{
			// MSIE <= 10
			$ret = preg_match('/MSIE (.*?);/', $_SERVER['HTTP_USER_AGENT'], $match);
			if ($ret < 1) 
			{
				// MSIE = 11
				$ret = preg_match('/Trident\/\d{1,2}.\d{1,2}; rv:([0-9]*)/', $_SERVER['HTTP_USER_AGENT'], $match);
			}
			if ($ret > 0 && $match[1] >= 9 && $match[1] <= 11) 
			{
				parse_str($HTTP_RAW_POST_DATA, $arr);
				foreach($arr as $key => $val) {
					$_POST[$key] = $val;
				}
			}
		}
	}
	
	# sleep(2);
	# require_once
	require_once(dirname(__FILE__)."/../libraries/meekrodb.2.3.class.php");
	require_once(dirname(__FILE__)."/../libraries_nosync/config.php");
	require_once(dirname(__FILE__)."/common_func.lib.php");

	
	# DB connecting include 분리
	DB::$user = $_cfg['db']['game']['user'];
	DB::$password = $_cfg['db']['game']['password'];
	DB::$dbName = $_cfg['db']['game']['dbName'];
	DB::$host = $_cfg['db']['game']['host'];
	DB::$port = $_cfg['db']['game']['port'];
	DB::$encoding = 'utf8';
	DB::$error_handler = 'my_error_handler';

	# json out
	$_OUT_JSON = array();
	
	# system : client ip
	$http_headers = getallheaders();
	if ( isset($http_headers["X-Forwarded-For"]) )
	{
		$_SERVER['REMOTE_ADDR'] = $http_headers["X-Forwarded-For"];
	}
	
		
	
	
	

?>
