<?php

namespace App\Ol\TW;

use Lib\App\BaseApp;
use Lib\App\Oauth;
use Lib\NetWork\Request;

/**
 * @todo 台湾网游游戏Secure模块处理
 *
 * [svn开发环境地址]：
 *     http://svn.ids111.com/dgc/dgc_secure_online/program/secure_TW_tag/dgc_TW_secure_online-trunk
 *
 *
 * @package App\Ol\TW
 *
 */
Class Secure extends BaseApp
{

    private $module_name = 'secure';

    /**
     * 微信AppID：wxff23efc69058a60f 
     * 微信AppSecret：90c211a20d47fe47bb92a3d4f6057280 
     * PackageName：tw.com.idealgame.yld 
     */


    /**
     * @todo 获取token
     */
    public function oauth_request_token()
    {
        //方法配置信息
        $config = REQUEST_CONFIG[$this->module_name][__FUNCTION__];
        $url = HOST_URL . $config['api'];            //请求地址
        $data = $config['data'];                     //请求参数
        $method = $config['method'];                 //请求方式
        $head = REQUEST_CONFIG['common_headers']; //请求头
        //计算加密数据
        $oauth = new Oauth();
        $base_string = $oauth->base_string($method, $url, $head);
        $hash_string = $oauth->hashsign($base_string, GAME_CONFIG['secret'], '');
        //生成请求头
        $headers = $oauth->createHeaders($head, $hash_string, $hash_string);
        //发送请求
        $request = new Request();
//        $result = $request->sendCurlPostData($url, $data, $headers);
        $result = $request->sendCurlGet($url, $data, $headers);
        $request->saveOauthRequestToken($result);
    }


}