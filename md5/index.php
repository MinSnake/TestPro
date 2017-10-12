<?php

//echo md5('DD6053276574' . 'idreamsky');
//echo md5('DD6053276562' . 'idreamsky');


//$tx_arr = array(
//    'orderId'      => 'DD6053276559',
//    'openid'       => 'd7f97d22bbe50e010ec5d4ea18a97b29',
//    'amount'       => 1000,
//    'actcurrency'  => 'KRW',
//    'actualAmount' => 1000,
//    'dgc_amount'   => 1000,
//    'p_identifier' => '0910087366',
//    'currency'     => 'KRW',
//    'success'      => 0,
//    'extraInfo'    => '20170915390587054',
//    'channel_id'   => '156',
//    'channelname'  => 'GooglePay',
//    'secret'       => 'e6d87b644de6bdd053c0',
//);
//
////secret  ----  e6d87b644de6bdd053c0 //android
//
$ld_arr = array(
    "orderId"      => "DD6053276574",
    "openid"       => "c103bb5139f059fa900253cb809b8627",
    "amount"       => 1.09,
    "actcurrency"  => "USD",
    "actualAmount" => 1.09,
    "dgc_amount"   => 1.09,
    "p_identifier" => "test03",
    "currency"     => "USD",
    "success"      => 0,
    "extraInfo"    => "20170921390662016",
    "channel_id"   => "401",
    "channelname"  => "韩国 AppStore",
    "gameparam"    => "paycallback",
    "created"      => "1505977589",
    "sign"         => "a51d73a864c380af03f7f15b2ae32d0f"
);
//
//
$signArray = array(
    'orderId', 'openid', 'amount','actcurrency', 'actualAmount',
    'dgc_amount', 'p_identifier','currency', 'success','extraInfo',
    'channel_id','channelname'
);
//
//$signText_tx = '';
//foreach ($tx_arr as $key=>$value) {
//    if (in_array($key, $signArray))
//    {
//        //还需要加上secret=cunsumer_secret,后面需要'&'
//        $signText_tx .= "$key=$value&";
//    }
//}
//
$signText_ld = '';
foreach ($ld_arr as $key=>$value) {
    if (in_array($key, $signArray))
    {
        //还需要加上secret=cunsumer_secret,后面需要'&'
        $signText_ld .= "$key=$value&";
    }
}
//
//print_r('TX原串：' . $signText_tx . PHP_EOL);
//
//print_r('TX加密后' . md5($signText_tx.'secret=e6d87b644de6bdd053c0') . PHP_EOL);
////echo md5($signText_tx.'secret=e6d87b644de6bdd053c0');
//
//print PHP_EOL . PHP_EOL;
//

// ios          0d833dddfc7bf6f2a997
// android      e6d87b644de6bdd053c0
$signText_ld = $signText_ld.'secret=0d833dddfc7bf6f2a997';
print_r('LD原串: ' . $signText_ld . PHP_EOL);

echo '<br>';

print_r('LD加密后: ' . md5($signText_ld) . PHP_EOL);








