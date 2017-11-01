<?php

//游戏数据配置
define('GAME_CONFIG',array(
    'key'    => '8fee977f5ba1244dc4f1',
    'secret' => '02f1221f49bb90bc68f3'
));

define('TEST_HOST', array(
    'secure' => 'http://cm.asia.secure.me',
    'feed'   => 'http://cm.usa.feed.me',
    'pay'    => 'http://cm.usa.pay.me',
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

        'host' => 'http://cm.asia.secure.me',
//        'host' => 'http://secure.overseas.ids111.com',

        'oauth/request_token' => array(
            'url' => 'oauth/request_token',
            'sign_url' => 'oauth/request_token',
            'method' => 'POST', //POST, GET
            'data' => array(
                'nudid' => '83q1q11n1_3229119054873088411r800',
                'udid'  => '00000000-439c-a1d4-ffff-ffff8cadaa45e',
            ),
        ),
        'oauth/authenticate' => array(
            'url' => 'oauth/authenticate',
            'sign_url' => 'oauth/authenticate',
            'method' => 'POST', //POST, GET
            'data' => array(
                'pack_ver'              => '2.1',
                'device_number'         => '18682168080',
                'device_system_version' => '7.1.1',
                'device_resolution'     => '1080X1920',
                'device_cpu_freq'       => '1900800',
                'nudid' => '83q1q11n1_3229119054873088411r800',
                'udid'  => '00000000-439c-a1d4-ffff-ffff8cadaa45e',
                'login_type'            => '4',
                'device_model'          => 'MI+6',
                'device_identifier'     => '865873031141389',
                'channel_id'            => 'TEST0000000',
                'device_brand'          => 'Xiaomi',
                'oauth_token'           => '', //这里暂定为空，需要程序中手动的实时去填充这个字段
                'device_google_account' => '',
            ),

        ),
        'oauth/access_token' => array(
            'url' => 'oauth/access_token',
            'sign_url' => 'oauth/access_token',
            'method' => 'POST', //POST, GET
            'data' => array(
                'nudid' => '83q1q11n1_3229119054873088411r800',
                'udid'  => '00000000-439c-a1d4-ffff-ffff8cadaa45e',
            ),
        ),
    ),


    'feed' => array(

        'host' => 'http://cm.usa.feed.me',
//        'host' => 'http://feed.overseas.ids111.com',


        'account/verify_credentials' => array(
            'url' => 'account/verify_credentials',
            'sign_url' => 'account/verify_credentials',
            'method' => 'GET',
            'data' => array(
                'game_version' => '1.0.1',
                'channel_id'   => 'TEST0000000',
                'nudid' => '83q1q11n1_3229119054873088411r800',
                'udid'  => '00000000-439c-a1d4-ffff-ffff8cadaa45e',
                'sign_version' => '0',
                'init'         => '1',
                'sdk_version'  => '2.0',
            ),
        ),

        'fortumo/sdkcallback' => array(
            'url' => 'fortumo/sdkcallback',
            'sign_url' => 'fortumo/sdkcallback',
            'method' => 'GET',
            'data' => array(
                'order_id'     => 'CM4149627',
                'user_id'      => '460025000498114',
                'payment_code' => '1509329285109a1',
                'service_id'   => 'a81a8e0de31292b1d1c951a288192697',
            ),

        ),

        //查询fortumo订单支付信息
        'fortumo/payinfo' => array(
            'url' => 'fortumo/payinfo',
            'sign_url' => 'fortumo/payinfo',
            'method' => 'POST',
            'data' => array(
                'order_id'     => 'CM4149627',
                'user_id'      => '460025000498114',
                'payment_code' => '1509329285109a1',
                'service_id'   => 'a81a8e0de31292b1d1c951a288192697',
            ),
        ),

        //查询乐逗订单支付信息
        'order_inquire' => array(
            'url' => 'order_inquire',
            'sign_url' => 'order_inquire',
            'method' => 'POST',
            'data' => array(
                'order_id'     => 'CM4149473',
                'player_id'    => '',
                'paymentstate' => '',
                'created'      => strtotime('2017-10-27'),
                'updated'      => strtotime('2017-10-28'),
            ),
        ),
    ),


    'pay' => array(

        'host' => 'http://cm.usa.pay.me',
//        'host' => 'http://sdkpay.overseas.ids111.com',

        'payments/create' => array(
            'url' => 'payments/create',
            'sign_url' => 'payments/create',
            'method' => 'POST',
            'data' => array(
                "product_id"=> "13253",
                "recharge"=> "1.0",
                "discount"=> 1,
                "server_id"=> "",
                "paymethod"=> "403",
                "paymentstate"=> "1",
                "extral_info"=> "",
                "auth_game_type"=> "2",
                "quantity"=> 1,
                "price"=> "10.0",
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