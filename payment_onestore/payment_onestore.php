<?php
	require_once "libraries/common.lib.php";
	require_once "libraries/common_func.lib.php";
	
	if ( isset($_POST['an']) ) $account_no = intval($_POST['an']);
	if ( isset($_POST['game_key']) ) $game_key = trim($_POST['game_key']);
	
	if ( isset($_POST['txid']) ) $txid = trim($_POST['txid']);
	if ( isset($_POST['signdata']) ) $signdata = trim($_POST['signdata']);
	
	
	if ( isset($_GET['an']) ) $account_no = intval($_GET['an']);
	if ( isset($_GET['game_key']) ) $game_key = trim($_GET['game_key']);
	
	if ( isset($_GET['txid']) ) $txid = trim($_GET['txid']);
	if ( isset($_GET['signdata']) ) $signdata = trim(urlencode($_GET['signdata']));


	$txid = "TX_00000000493734";
	$signdata = "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";
	
	# check params
	if ( isset($account_no) == false || $account_no == 0 || isset($game_key) == false || $game_key == "" )
	{
		$_OUT_JSON["rs"] = -2;
		echo json_encode($_OUT_JSON);
		exit;
	}
	
	if ( isset($txid) == false || $txid == "" || isset($signdata) == false || $signdata == "" )
	{
		$_OUT_JSON["rs"] = -2;
		echo json_encode($_OUT_JSON);
		exit;
	}
	
	// dev
	$host = "https://iapdev.tstore.co.kr/digitalsignconfirm.iap";
	// live  : https://iap.tstore.co.kr/digitalsignconfirm.iap
	$headers = "Content-Type: application/json\r\nAccept: application/json\r\n";
	$params = array(
	    'txid' => $txid,
	    'appid' => "OA00718081",
	    'signdata' => $signdata
	);
	$params = json_encode($params);
	$result = http_request("POST", $headers, $host, $params);
	$result = json_decode($result);


	if ( $result->detail == "0000" ) {
		// sucess
		$_OUT_JSON["rs"] = 0;
		
		// server insert
		
		// server log
		
	} else {
		// failed
		$_OUT_JSON["rs"] = 1;
		
	}

	echo json_encode($_OUT_JSON);
	exit;
	
	 
	
?>
