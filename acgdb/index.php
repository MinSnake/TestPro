<?php
/**
 * @todo 发送GET请求
 * @param $url 请求地址
 * @author Saki <zha_zha@outlook.com>
 * @date 2014-5-29上午10:58:30
 * @version v1.0.0
 */
function sendGetRequest($url) {
	ob_start();
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL,$url);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
	curl_exec($ch);
	$result = ob_get_contents ();
	ob_end_clean ();
	curl_close ( $ch );
	return $result;
}


//$url = 'http://api.acgdb.com/current_season';


$url = 'http://api.acgdb.com/detail?id=535a2d6e1d41c8411177575e';
$json = sendGetRequest($url);
echo $json;
// $obj = json_decode($json);

// //今日动画列表
// $time_today = $obj->time_today;
// //所有动画的详细信息
// $animes = $obj->animes;

// foreach ($time_today as $k=>$toweek){
// 	echo "星期".($k+1);
// 	foreach ($toweek as $today){
// 		echo "<br>";
// 		getinfo($today->anime);
// 		echo "<br>";
// 		echo '放送时间：' . $today->time;
// 		echo "<br>";
// 	}
// }

// function getinfo($id){
// 	$url = 'http://api.acgdb.com/detail?id='.$id;
// 	$json = sendGetRequest($url);
// 	$obj = json_decode($json);
// 	var_dump($obj);
// }





