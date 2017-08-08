<?php
	require_once "libraries/common.lib.php";
	
	
	if ( isset($_POST['an']) ) $account_no = intval($_POST['an']);
	if ( isset($_POST['game_key']) ) $game_key = trim($_POST['game_key']);
	if ( isset($_POST['sns_type']) ) $sns_type = trim($_POST['sns_type']);
	if ( isset($_POST['sns_id']) ) $sns_id = trim($_POST['sns_id']);
	
	if ( isset($_GET['an']) ) $account_no = intval($_GET['an']);
	if ( isset($_GET['game_key']) ) $game_key = trim($_GET['game_key']);
	if ( isset($_GET['sns_type']) ) $sns_type = trim($_GET['sns_type']);
	if ( isset($_GET['sns_id']) ) $sns_id = trim($_GET['sns_id']);
	
	# check params
	if ( isset($account_no) == false || isset($game_key) == false || $game_key == "" )
	{
		$_OUT_JSON["rs"] = -2;
		echo json_encode($_OUT_JSON);
		exit;
	}
	
	if ( isset($sns_type) == false || $sns_type == "" )
	{
		$_OUT_JSON["rs"] = -2;
		echo json_encode($_OUT_JSON);
		exit;
	}
	
	if ( $sns_type != "GUEST" && (isset($sns_id) == false || $sns_id == "") )
	{
		$_OUT_JSON["rs"] = -2;
		echo json_encode($_OUT_JSON);
		exit;
	}
	
	
	# 변수
	$table_name = "";
	$account_no_sns = 0;
	$account_no_link = 0;
	$game_no = 0;
	$is_link = false;
	$security_token = md5("User_".date("His")."_".rand());
	
	
	# 테이블 이름 정의
	if ( $sns_type == "GOOGLE" )			$table_name = "act_sns_google";
	else if ( $sns_type == "FACEBOOK" )		$table_name = "act_sns_facebook";
	else if ( $sns_type == "NAVER" )		$table_name = "act_sns_naver";
	
	
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
	
	
	# SNS 조회 및 SNS 등록
	if ( $sns_type == "GUEST" )
	{
		DB::startTransaction();
			
		DB::insert('act', array(
			'is_guest' => 1,
			'date_reg' => DB::sqleval("NOW()"),
			'date_acc' => DB::sqleval("NOW()")
		));
		$account_no_sns = DB::insertId();
		$check_act = DB::affectedRows();
		
		if ( $check_act != 0 )
		{
			DB::commit();
		}
		else
		{
			DB::rollback();
			
			$_OUT_JSON["rs"] = -1;
			echo json_encode($_OUT_JSON);
			exit;
		}
	}
	else
	{
		$sql = "select account_no from $table_name where sns_id='$sns_id'";
		$res = DB::queryFirstRow($sql);
		if ( $res != null )
		{
			$account_no_sns = intval($res['account_no']);
		}
		else
		{
			DB::startTransaction();
			
			DB::insert('act', array(
				'date_reg' => DB::sqleval("NOW()"),
				'date_acc' => DB::sqleval("NOW()")
			));
			$account_no_sns = DB::insertId();
			$check_act = DB::affectedRows();
			
			DB::insert($table_name, array(
			  'sns_id' => $sns_id,
			  'account_no' => $account_no_sns
			));
			$check_sns = DB::affectedRows();
			
			if ( $check_act != 0 && $check_sns != 0 )
			{
				DB::commit();
			}
			else
			{
				DB::rollback();
				
				$_OUT_JSON["rs"] = -1;
				echo json_encode($_OUT_JSON);
				exit;
			}
		}
	}
	
	
	# 링크 
	$sql = "select account_no_link from act_link where account_no=$account_no_sns and game_no=$game_no";
	$res = DB::queryFirstRow($sql);
	if ( $res != null )
	{
		$is_link = true;
		$account_no_link = intval($res['account_no_link']);
	}
	
	if ( $is_link == true )
	{
		if ( $account_no != 0 && $account_no != $account_no_link )
		{
			$_OUT_JSON["rs"] = 2;
			$_OUT_JSON["direct_an"] = $account_no_link;
			$_OUT_JSON["direct_sns_type"] = $sns_type;
			$_OUT_JSON["direct_sns_id"] = $sns_id;
			
			echo json_encode($_OUT_JSON);
			exit;
		}
	}
	else
	{
		$account_no_link = $account_no;
		if ( $account_no_link == 0 )
			$account_no_link = $account_no_sns;
		
		DB::startTransaction();
		
		DB::insert("act_link", array(
		  'account_no' => $account_no_sns,
		  'game_no' => $game_no,
		  'account_no_link' => $account_no_link,
		  'date_reg' => DB::sqleval("NOW()")
		));
		$check_link = DB::affectedRows();
		
		if ( $check_link != 0 )
		{
			DB::commit();
			 
			$is_link = true;
		}
		else
		{
			DB::rollback();
			
			$_OUT_JSON["rs"] = -1;
			echo json_encode($_OUT_JSON);
			exit;
		}
	}
	
	if ( $is_link == true )
	{
		DB::update('act', array(
		  'date_acc' => DB::sqleval("NOW()")
		),
		   "account_no=%i", $account_no_sns
		);
			
		if ( $account_no == 0 )
		{
			DB::startTransaction();
			
			DB::update('act_link', array(
			  'security_token' => $security_token
			),
			   "account_no=%i and game_no=%i", $account_no_link, $game_no
			);
			$check_update = DB::affectedRows();
			if ( $check_update != 0 )
			{
				DB::commit();
			}
			else
			{
				DB::rollback();
				
				$_OUT_JSON["rs"] = -1;
				echo json_encode($_OUT_JSON);
				exit;
			}
		}
		
	
		if ( $account_no == 0 )
		{
			$_OUT_JSON["rs"] = 0;
			$_OUT_JSON["an"] = $account_no_link;
			$_OUT_JSON["st"] = $security_token;
			$_OUT_JSON["sns_type"] = $sns_type;
		}
		else
		{
			$_OUT_JSON["rs"] = 1;
			$_OUT_JSON["sns_type"] = $sns_type;
		}
		
	}
	
 
	echo json_encode($_OUT_JSON);
	exit;
	
?>
