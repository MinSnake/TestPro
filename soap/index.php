<?php
require_once('Demo.php');
$soap = new SoapServer(null,array("location"=>"http://test.me/soap/index.php","uri"=>"index.php"));
$soap->setClass("Demo");
$soap->handle();