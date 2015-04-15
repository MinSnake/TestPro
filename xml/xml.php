<?php
$xml = "<xml>
		<ToUserName><![CDATA[gh_893326404129]]></ToUserName>
		<FromUserName><![CDATA[oOcYBuBfrihsQR2xcANju2pGsFzA]]></FromUserName>
		<CreateTime>1401605396</CreateTime>
		<MsgType><![CDATA[text]]></MsgType>
		<Content><![CDATA[地方松岛枫深大]]></Content>
		<MsgId>1234567890123456</MsgId>
		</xml>";

$p = xml_parser_create();
xml_parser_set_option($p, XML_OPTION_CASE_FOLDING, false);
xml_parse_into_struct($p, $xml, $vals, $index);
xml_parser_free($p);
/**/
$newArr = array();
foreach($vals as $xmlObj){
	if($xmlObj['tag'] != 'xml'){
		$temp[$xmlObj['tag']] = $xmlObj['value'];
		array_push($newArr, $temp);
	}
}

$res = (object)end($newArr);

echo $res->ToUserName;