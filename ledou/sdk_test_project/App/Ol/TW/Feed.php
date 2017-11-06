<?php

namespace App\Ol\TW;

use Lib\App\BaseApp;
use Lib\App\Oauth;
use Lib\Log\Log;
use Lib\NetWork\Request;


/**
 * @todo 台湾网游Feed模块处理
 *
 * [svn开发环境地址]：
 *     http://svn.ids111.com/dgc/dgc_sdkfeed_online/program/atrunk_taiwan/olfeed_TW-trunk
 *
 * @package App\Ol\TW
 */
class Feed extends BaseApp
{

    private $module_name = 'feed';

    private $host = FEED_HOST_URL;


    public function account_verify_credentials()
    {
        //方法配置信息
        $config = REQUEST_CONFIG[$this->module_name][__FUNCTION__];
        $url = $this->host . $config['api'];            //请求地址
        $data = $config['data'];                     //请求参数
        $method = $config['method'];                 //请求方式
        $head = REQUEST_CONFIG['common_headers'];    //请求头
        $head['oauth_token'] = TOKEN_CONFIG['key'];
        //计算加密数据
        $oauth = new Oauth();
        $base_string = $oauth->base_string($method, $url, $head);
        $hash_string = $oauth->hashsign($base_string, GAME_CONFIG['secret'], TOKEN_CONFIG['secret']);
        //生成请求头
        $headers = $oauth->createHeaders($head, $hash_string, $hash_string);
        //发送请求
        $request = new Request();
        $request->sendCurlGet($url, $data, $headers);
    }

}