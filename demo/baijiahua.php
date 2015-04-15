<?php
include_once "phprpc/phprpc_client.php";
$client = new PHPRPC_Client ( 'http://10.1.0.173:7000/frdif/n_frdif.asmx?WSDL' );
$username = 'APP';
$password = '3B46F35A91DC52DE';


/**/
$cmdid = 9001;
$inputpara = '';
$refoutputpara = '';
$refreturn = '';
$referrormsg = '';
$client->processdata($username,$password,$cmdid,$inputpara,$refoutputpara,$refreturn,$referrormsg);

SoapClient

?>