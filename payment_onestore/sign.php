<?php
	require_once "libraries/common.lib.php";
	

	if ( isset($_POST['an']) ) $account_no = intval($_POST['an']);
	if ( isset($_POST['st']) ) $security_token = trim($_POST['st']);
	if ( isset($_POST['game_key']) ) $game_key = trim($_POST['game_key']);
	
	if ( isset($_GET['an']) ) $account_no = intval($_GET['an']);
	if ( isset($_GET['st']) ) $security_token = trim($_GET['st']);
	if ( isset($_GET['game_key']) ) $game_key = trim($_GET['game_key']);
	
	
	# check params
	if ( isset($account_no) == false || $account_no == 0  )
	{
		$_OUT_JSON["rs"] = -2;
		echo json_encode($_OUT_JSON);
		exit;
	}
	
	if ( isset($security_token) == false || $security_token == ""   )
	{
		$_OUT_JSON["rs"] = -2;
		echo json_encode($_OUT_JSON);
		exit;
	}
	
	if ( isset($game_key) == false || $game_key == "" )
	{
		$_OUT_JSON["rs"] = -2;
		echo json_encode($_OUT_JSON);
		exit;
	}
 
 
	# 게임 키 조회
	$sql = "select game_no from info_game where game_key='$game_key'";
	$res = DB::queryFirstRow($sql);
	if ( $res != null )
	{
		$game_no = intval($res['game_no']);
	}
	else
	{
		$_OUT_JSON["rs"] = -1;
		echo json_encode($_OUT_JSON);
		exit;
	}
	
	# 조회
	$success = false;
	if ( $security_token != "" )
	{
		$sql = "select security_token from act_link where account_no=$account_no and game_no=$game_no";
		$res = DB::queryFirstRow($sql);
		if ( $res != null && trim($res['security_token']) == $security_token )
		{
			$success = true;
		}
	}
	
	if ( $success == true )
	{
		$_OUT_JSON["rs"] = 0;
		$_OUT_JSON["an"] = $account_no;
		$_OUT_JSON["st"] = $security_token;
	}
	else
	{
		$_OUT_JSON["rs"] = 1;
	}
		
	echo json_encode($_OUT_JSON);
	exit;
	
?>
