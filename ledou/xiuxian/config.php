<?php

//游戏数据配置
define('GAME_CONFIG',array(
    'key'    => '8fee977f5ba1244dc4f1',
    'secret' => '02f1221f49bb90bc68f3'
));

define('REQUEST_CONFIG', array(
    //公共请求头数据
    'common_headers' => array(
        'oauth_consumer_key'     => GAME_CONFIG['key'],
        'oauth_signature_method' => 'HMAC-SHA1',
        'oauth_timestamp'        => (string)time(),
        'oauth_nonce'            => '648574602577142938',
        'oauth_version'          => '1.0',
        'oauth_callback'         => 'dgc-request-token-callback',
    ),
    //secure模块请求数据配置
    'secure' => array(
        'oauth/request_token' => array(
            'url' => 'http://secure.overseas.ids111.com/oauth/request_token',
            'sign_url' => 'http://secure.overseas.ids111.com/oauth/request_token',
            'method' => 'POST', //POST, GET
            'data' => array(
                'nudid' => '83q1q11n1_3229119054873088411r854',
                'udid'  => '00000000-439c-a1d4-ffff-ffff8c78a45e',
            ),
        ),
        'oauth/authenticate' => array(
            'url' => 'http://secure.overseas.ids111.com/oauth/authenticate',
            'sign_url' => 'http://secure.overseas.ids111.com/oauth/authenticate',
            'method' => 'POST', //POST, GET
            'data' => array(
                'pack_ver'              => '2.1',
                'device_number'         => '18682168085',
                'device_system_version' => '7.1.1',
                'device_resolution'     => '1080X1920',
                'device_cpu_freq'       => '1900800',
                'nudid'                 => '83q1q11n1_3229119054873088411r854',
                'login_type'            => '4',
                'device_model'          => 'MI+6',
                'device_identifier'     => '865873031141389',
                'channel_id'            => 'TEST0000000',
                'device_brand'          => 'Xiaomi',
                'udid'                  => '00000000-439c-a1d4-ffff-ffff8c78a45e',
                'oauth_token'           => '', //这里暂定为空，需要程序中手动的实时去填充这个字段
                'device_google_account' => '',
            ),

        ),
        'oauth/access_token' => array(
            'url' => 'http://secure.overseas.ids111.com/oauth/access_token',
            'sign_url' => 'http://secure.overseas.ids111.com/oauth/access_token',
            'method' => 'POST', //POST, GET
            'data' => array(
                'nudid' => '83q1q11n1_3229119054873088411r854',
                'udid'  => '00000000-439c-a1d4-ffff-ffff8c78a45e',
            ),
        ),
    ),


    'feed' => array(
        'account/verify_credentials' => array(
            'url' => 'http://feed.overseas.ids111.com/account/verify_credentials',
            'sign_url' => 'http://feed.overseas.ids111.com/account/verify_credentials',
            'method' => 'GET',
            'data' => array(
                'game_version' => '1.0.1',
                'channel_id'   => 'TEST0000000',
                'udid'         => '00000000-439c-a1d4-ffff-ffff8c78a45e',
                'nudid'        => '83q1q11n1_3229119054873088411r854',
                'sign_version' => '0',
                'init'         => '1',
                'sdk_version'  => '2.0',
            ),
        ),
    ),


    'pay' => array(
        'payments/create' => array(
            'url' => 'http://sdkpay.overseas.ids111.com/payments/create',
            'sign_url' => 'http://sdkpay.overseas.ids111.com/payments/create',
            'method' => 'POST',
            'data' => array(
//                'product_id'     =>'44',
//                'discount'       => 1,
//                'recharge'       => '1.0' ,
//                'charge_amount'  => 'US$0.99' ,
//                'server_id'      => '',
//                'paymethod'      => '156' ,
//                'paymentstate'   => '1' ,
//                'extral_info'    => '',
//                'quantity'       => 1,
//                'auth_game_type' => '2' ,
//                'price'          => '1.0' ,
//                'nudid'          => '21s51s7s1666938_4133082852qpqr1nq',
//                'channel_id'     => 'TEST0000000' ,
//                'udid'           => '00000000-41f2-376c-f9db-9d371fcaf9a3' ,
//                'currency'       => 'USD',
//                'cli_ver'        => 'pay-3.2.2.14' ,
//                'type'           => '2'

                "product_id"=> "44",
                "charge_amount"=> "US$0.99",
                "recharge"=> "1.0",
                "discount"=> 1,
                "server_id"=> "",
                "paymethod"=> "156",
                "paymentstate"=> "1",
                "extral_info"=> "",
                "auth_game_type"=> "2",
                "quantity"=> 1,
                "price"=> "1.0",
                "nudid"=> "737po0_8567946855879137oo97352n19",
                "type"=> "2",
                "channel_id"=> "TEST0000000",
                "udid"=> "00000000-0aad-c1e4-ffff-fffff310cc6a",
                "currency"=> "USD",
                "cli_ver"=> "1.0.0"
            ),
        ),

    ),
));