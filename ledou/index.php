<?php

function checkSign($data){
	if(!$data){
		return false;
	}
	//$sign = $data["sign"];
	$signstr = strtoupper(md5($data['packageName'].
							  $data['productId'].
							  $data['token'].
							  $data['orderId'].
							  $data['purchaseTime'].
							  $data['subscrid'].
							  $data['sign_key']));
	 return $signstr;
}


$data = array(
	'packageName' => 'com.idreamsky.haiwai.test',
	'productId' => 'com.idreamsky.linefollower.pro',
	'token' => 'ohfbhlkckohkngecijjgiodk.AO-J1OwSAJYVy-mmOr7gXMIQ3Rp1KnLJ01HSVEVxTnOUlNFkOqJ8gvYd314dHKVpggDhyPbcrRWM6dOboVhqSW4sN0E404hyr1S1fuH5Hu-fs14256j64ZkyqqbHnVRBZWzTbkgT1rMfAkxlFMNPRcDBRXcdsXoBaB',
	'orderId' => 'CM3408406436',
	'purchaseTime' => '1495519378847',
	'subscrid' => 'GPA.3383-9565-8224-34794',
	'sign_key' => '02f1221f49bb90bc68f3',
);

echo checkSign($data);