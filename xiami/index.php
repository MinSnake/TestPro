<?php
/**
 * App Key： 23136646
 * App Secret： 645b7a89c0c0d8b17a0d926b988b08f9
 */
include_once 'top/TopClient.php';
include_once 'xiami/';
$c = new TopClient;
$c->appkey = '23136646';
$c->secretKey = '645b7a89c0c0d8b17a0d926b988b08f9';
$req = new AlibabaXiamiApiSearchSongsGetRequest();
// $a = new AlibabaGeoipGetRequest();
$req->setKey("刘德华");
$req->setPage(1);
$req->setLimit(10);
$req->setIsPub("all");
$req->setCategory("-1");
$resp = $c->execute($req);