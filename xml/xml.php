<?php
//$xml = "<xml>
//		<ToUserName><![CDATA[gh_893326404129]]></ToUserName>
//		<FromUserName><![CDATA[oOcYBuBfrihsQR2xcANju2pGsFzA]]></FromUserName>
//		<CreateTime>1401605396</CreateTime>
//		<MsgType><![CDATA[text]]></MsgType>
//		<Content><![CDATA[地方松岛枫深大]]></Content>
//		<MsgId>1234567890123456</MsgId>
//		</xml>";
//
//$p = xml_parser_create();
//xml_parser_set_option($p, XML_OPTION_CASE_FOLDING, false);
//xml_parse_into_struct($p, $xml, $vals, $index);
//xml_parser_free($p);
///**/
//$newArr = array();
//foreach($vals as $xmlObj){
//	if($xmlObj['tag'] != 'xml'){
//		$temp[$xmlObj['tag']] = $xmlObj['value'];
//		array_push($newArr, $temp);
//	}
//}
//
//$res = (object)end($newArr);
//
//echo $res->ToUserName;
$test =
'<?xml version="1.0" encoding="utf-8"?>
<GXG_RES type="BillingLog">
    <result>
        <status>9</status>
        <detail>9100</detail>
        <message>요청하신 조건과 일치하는 정보가 없습니다.</message>
        <appid>OA00027256</appid>
        <count>0</count>
    </result>
</GXG_RES>';

$xml = simplexml_load_string($test);
$xmljson= json_encode($xml);
$xml=json_decode($xmljson,true);
var_dump($xml);

$test2 =
'<?xml version="1.0" encoding="utf-8"?>
<GXG_RES type="BillingLog">
    <result>
        <status>0</status>
        <detail>0000</detail>
        <message>successfully checked.</message>
        <appid>OA00285882</appid>
        <count>2</count>
        <billing_log>
            <item>
                <tid>20160709191552028174</tid>
                <product_id>0901247195</product_id>
                <log_time>20160709191641</log_time>
                <charging_id>11111111111</charging_id>
                <charge_amount>33,000</charge_amount>
                <detail_pname>T data coupon 5GB</detail_pname>
                <bp_info>X</bp_info>
                <tcash_flag>N</tcash_flag>
            </item>
            <item>
                <tid>20160709191649869595</tid>
                <product_id>0901247195</product_id>
                <log_time>20160709191733</log_time>
                <charging_id>11111111111</charging_id>
                <charge_amount>33,000</charge_amount>
                <detail_pname>T data coupon 5GB</detail_pname>
                <bp_info>X</bp_info>
                <tcash_flag>N</tcash_flag>
            </item>
        </billing_log>
    </result>
</GXG_RES>';

$xml = simplexml_load_string($test2);
$xmljson= json_encode($xml);
$xml=json_decode($xmljson,true);
var_dump($xml['result']['billing_log']);