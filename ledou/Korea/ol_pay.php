<?php

// $orderData['amount']=9.190;
// echo round(0.0400,2)."</br>";
// echo round(floatval($orderData['amount']), 2); exit;

// echo "</br>"."\n";

//orderId=DD2003799254&openid=9d1ebbdb7a1ca3215ceef2deffa4195f&amount=1&actualAmount=1&dgc_amount=1&p_identifier=tw.idealgame.yli.68&currency=TWD&success=0&gameparam=paycallback&extraInfo=extra_info&created=1491564136&sign=b143276999976623e784506df7ea522e
echo "send_data:  " . md5('orderId=DD3491832232&openid=589486c71619d810737a386dd5aa8818&amount=9.81&actualAmount=9.81&dgc_amount=60&product_id=31490179650495&currency=TWD&success=0&extraInfo=tt&318cacb4147f0614c774');


echo "</br>" . "\n";

echo "req_notice:  " . md5('DD2003901905idreamskyyinlian') . "</br>" . "\n";

echo "update_notice:  " . md5('DD20039013486USDidreamskyyinlian') . "</br>" . "\n";

// echo strtoupper(md5('idreamsky@2016DD3220845478'));
// exit;

// $reqData=array(
//     "dsky_amount"=>3,
//     "dsky_orderid"=>"DD2003901603",
//     "status"=>"0",
//     "currency"=>'USD',
// //     "currency"=>"TWD",
// //     "sign"=>"9fa400e5a9cc95f7fdadad69995ab9ca",
// //     "cp_info"=>'{"url":"zhiguan_callback","MyCardTradeNo":"MMS1610190047156817"}',
// //     "callback_method"=>"zhiguan_callback",
// //     "msg"=>"簽名成功",
// );

$reqData = array(
    "dsky_amount" => 3,
    "dsky_orderid" => "DD2003901905",
    "status" => "0",
    "currency" => 'USD',
//     "currency"=>"TWD",
//     "sign"=>"9fa400e5a9cc95f7fdadad69995ab9ca",
//     "cp_info"=>'{"url":"zhiguan_callback","MyCardTradeNo":"MMS1610190047156817"}',
//     "callback_method"=>"zhiguan_callback",
//     "msg"=>"簽名成功",
);


$singStr = sprintf('dsky_orderid=%s&dsky_amount=%s&status=%s&key=idreamsky2009',
    $reqData['dsky_orderid'], $reqData['dsky_amount'], $reqData['status']);
$rsign = md5($singStr);

echo "online_callback:  " . $rsign;


echo "</br></br>";

$singStr = sprintf('dsky_orderid=%s&dsky_amount=%s&currency=%s&status=%s&key=idreamsky2017',
    $reqData['dsky_orderid'], $reqData['dsky_amount'], $reqData['currency'], $reqData['status']);
$rsign = md5($singStr);

echo "online_callback_europe:  " . $rsign;


exit;

//md5("dsky_orderid={$params['dsky_orderid']}&dsky_amount={$params['dsky_amount']}&status={$params['status']}&key=idreamsky2009")){
