<?php

/**
 * 游戏数据配置
 */
define('GAME_CONFIG',array(
    'key'    => '67a671523a3b098cf561',
    'secret' => '6422592d6968c87d1132'
));


/**
 * @todo 路由配置
 * 区分了各个架构模块，映射  路由URL ->  对应模块的方法名
 */
define('ROUTES', array(

    'secure' => array(
        'oauth/request_token' => 'oauth_request_token',
        'oauth/authenticate' => 'oauth_authenticate',
        'oauth/access_token' => 'oauth_access_token',

    ),

    'feed' => array(
        'account/verify_credentials' => 'account_verify_credentials',
    ),

    'payment' => array(
        'payments/create' => 'payments_create',
    )


));


define('UDID',  '00000000-439c-a1d4-ffff-jindatest_01udid');
define('NUDID', '83q1q11n1_322911905_jindatest_01nudid');


/**
 * @todo 请求参数配置
 */
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


    'secure' => array(
        'oauth_request_token' => array(
            'api' => '/oauth/request_token',
            'method' => 'POST',
            'data' => array(),
        ),
        'oauth_authenticate' => array(
            'api' => '/oauth/authenticate',
            'method' => 'POST',
            'data' => array(
                'device_identifier' => '865873031141389',
                'oauth_token'       => '',
                'udid'              => UDID,
                'nudid'             => NUDID,
                'login_type'        => '4',
            ),
        ),
        'oauth_access_token' => array(
            'api' => '/oauth/access_token',
            'method' => 'POST',
            'data' => array(),
        ),
    ),

    'feed' => array(
        'account_verify_credentials' => array(
            'api' => '/account/verify_credentials',
            'method' => 'GET',
            'data' => array(
                'game_version' => '1.0.1',
                'channel_id'   => 'TEST0000000',
                'nudid'        => NUDID,
                'udid'         => UDID,
                'sign_version' => '0',
                'init'         => '1',
                'sdk_version'  => '2.0',
            ),
        ),
    ),

    'payment' => array(
        'payments_create' => array(
            'api' => '/payments/create',
            'method' => 'POST',
            'data' => array(
                "product_id"     => '228' . time(),  //道具id,13位 - 31510043681234
                "type"           => "8",               //支付形式

//                "product_id"     => "12136",  //道具id,13位
//                "type"           => "2",              //支付形式

                "product_name"   => "jinda_test",     //道具名称
                "p_identifier"   => "test01",      //道具标识
                "quantity"       => "1",              //数量
                "auth_game_type" => "1",              //游戏类型，1-网游，2-休闲
                "paymethod"      => "405",            //支付方式标识 31-支付宝，405-微信
                "currency"       => "CNY",            //订单币种
                "order_amount"   => "0.01",         //支付金额
                "extral_info"    => "string",         //透传字段
                "price"          => "0.01",         //道具价格
                "channel_id"     => "TEST0000000",    //渠道号
                "server_id"      => "1",              //游戏服务器
                "cli_ver"        => "pay-3.2.2.57",   //版本号
                "imei"           => "000000000000",
                "nudid"          => NUDID,
                "udid"           => UDID
            ),
        ),

    )


));





