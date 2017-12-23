<?php
//$a = '{
//    "product": [
//        {
//            "appid": "OA00718081",
//            "bp_info": "",
//            "charge_amount": 1000,
//            "detail_pname": "",
//            "log_time": "20170803105840",
//            "product_id": "0910084685",
//            "tid": "DD2003942753"
//        }
//    ],
//    "message": "정상검증완료.",
//    "detail": "0000",
//    "count": 1,
//    "status": 0
//}';
//
//$b = json_decode($a);
//
//var_dump($b);


$a = '[{"id":1050604451}]';

$b = json_decode($a);

var_dump($b);

echo $b[0]->id;
//echo $b[0]['id'];

//echo '123';

//$a = array(
//    'igaworks' => array(
//        'appkey' => '730227318',
//        'haskkey' => 'e14b2ce5c5ab46ce',
//    )
//);
//
//$s = json_encode($a);
//
//echo $s;