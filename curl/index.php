<?php

/**
 * @todo 发送POST请求
 * @param $url 请求地址
 * @param $data 请求参数
 * @author Saki <zha_zha@outlook.com>
 * @date 2014-5-29上午10:58:30
 * @version v1.0.0
 */
function sendPostRequest($url, $data) {
	$ch = curl_init ();
	curl_setopt ( $ch, CURLOPT_URL, $url );
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
	curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (compatible; MSIE 5.01; Windows NT 5.0)');
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
	curl_setopt($ch, CURLOPT_AUTOREFERER, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$tmpInfo = curl_exec($ch);
	if (curl_errno($ch)) {
		return curl_error($ch);
	}
	curl_close($ch);
	return $tmpInfo;
}

$appid = 'abcdefg123';
$appsecret = 'qwertyuiop555';
$tm = time();

//json数据
$data['cardno'] = 10000001;
$data['phone'] = '13545454545';
$data['tm'] = '2014-12-03,2014-12-11';
$json = json_encode($data);


$token = md5($appid.$appsecret.$tm.$json);

$url = 'http://bp.me/api/Vip/searchPoint?' . 
		'appid=' . $appid . '&'.
		'tm=' . $tm . '&' .
		'token=' . $token;

//传递数据

$res = sendPostRequest($url, $json);

echo $res;
