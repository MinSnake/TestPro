<?php
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

$url = 'http://bp.playwx.com/pay/wxPay/pay';
$data['tenant_id'] = 26;
$data['order_no'] = '201503242306232056';
$json = sendPostRequest($url, $data);
$json_obj = (Object)json_decode($json);
$wx_json = $json_obj->data;
?>
<html>
<script language="javascript">
function callpay(){
	WeixinJSBridge.invoke('getBrandWCPayRequest',<?php echo $wx_json; ?>,function(res){
		if(res.err_msg == 'get_brand_wcpay_request:ok'){
			//支付成功
		}else if(res.err_msg == 'get_brand_wcpay_request:cancel'){
			//支付过程中用户取消
		}else if(res.err_msg == 'get_brand_wcpay_request:fail'){
			//支付失败
		}
	});
}
</script>
<body>
<button type="button" onclick="callpay()">支付</button>
</body>
</html>