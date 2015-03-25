<?php
try {
	$soap = new SoapClient(null,array("location"=>"http://test.me/soap/index.php","uri"=>"index.php"));
	echo $soap->__soapCall("getName", array());
} catch(SoapFault $e){
	echo $e->getMessage();
} catch (Exception $e) {
	echo $e->getMessage();
}