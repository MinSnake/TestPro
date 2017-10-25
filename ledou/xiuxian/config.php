<?php

//游戏数据配置
define('GAME_CONFIG',array(
    'key'    => 'e19081b4527963d70c7a',
    'secret' => '8b61acd14a5811186163'
));

define('REQUEST_CONFIG', array(
    //公共请求头数据
    'common_headers' => array(
        'oauth_consumer_key'     => GAME_CONFIG['key'],
        'oauth_signature_method' => 'HMAC-SHA1',
        'oauth_timestamp'        => (string)time(),
        'oauth_nonce'            => '58111111-FA79-4A52-BB44-4E376CC0C624',
        'oauth_version'          => '1.0',
    ),
    //secure模块请求数据配置
    'secure' => array(
        'oauth/request_token' => array(
            'url' => 'http://secure.overseas.ids111.com:10016/oauth/request_token',
            'sign_url' => 'http://secure.overseas.ids111.com/oauth/request_token',
            'method' => 'POST', //POST, GET
            'data' => array(
                'nudid' => '83q1q11n1_3229119054873088411r854',
                'udid'  => '00000000-439c-a1d4-ffff-ffff8c78a45e',
            ),
        ),
        'oauth/authenticate' => array(
            'url' => 'http://secure.overseas.ids111.com:10016/oauth/authenticate',
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
            'url' => 'http://secure.overseas.ids111.com:10016/oauth/access_token',
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
            'url' => 'http://feed.overseas.ids111.com:10016/account/verify_credentials',
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


    'pay' => array(),
));