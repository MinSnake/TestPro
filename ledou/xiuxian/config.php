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
            'url'    => 'http://secure.overseas.ids111.com/oauth/request_token',
            'method' => 'POST', //POST, GET
            'data' => array(
                'nudid' => '83q1q11n1_3229119054873088411r854',
                'udid'  => '00000000-439c-a1d4-ffff-ffff8c78a45e',
            ),
        ),
        'oauth/authenticate' => array(


        ),
        'oauth/access_token' => array(


        ),
    ),


    'feed' => array(),


    'pay' => array(),
));