<?php

/**
 * 游戏数据配置
 */
define('GAME_CONFIG',array(
    'key'    => '8fee977f5ba1244dc4f1',
    'secret' => '02f1221f49bb90bc68f3'
));


/**
 * 台湾局域网的测试地址
 */
define('HOST_URL', 'http://olsecure.overseas.ids111.com:88');
//define('HOST_URL', 'http://olsecure.overseas.ids111.com:10015');

/**
 * @todo 路由配置
 * 区分了各个架构模块，映射  路由URL ->  对应模块的方法名
 */
define('ROUTES', array(

    'secure' => array(
        'oauth/request_token' => 'oauth_request_token',

    ),

    'feed' => array(),

    'payment' => array()


));


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
//            'api' => '/oauth/request_token',
//            'method' => 'POST',
            'api' => '',
            'method' => 'GET',
            'data' => array(),
        ),



    ),


));





