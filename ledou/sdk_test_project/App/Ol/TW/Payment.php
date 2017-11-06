<?php

namespace App\Ol\TW;

use Lib\App\BaseApp;
use Lib\App\Oauth;
use Lib\NetWork\Request;


/**
 * @todo 台湾网游Pay模块处理
 *
 * [svn开发环境地址]：
 *     http://svn.ids111.com:81/dgc_payment/source/taiwan_tag/tw_payment-trunk
 *
 *
 * @package App\Ol\TW
 */
class Payment extends BaseApp
{

    private $module_name = 'payment';

    private $host = PAYMENT_HOST_URL;


    public function payments_create()
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

        $base_string2 = $oauth->base_string($method, $url, $head, $data);
        $hash_string2 = $oauth->hashsign($base_string2, GAME_CONFIG['secret'], TOKEN_CONFIG['secret']);
        //生成请求头
        $headers = $oauth->createHeaders($head, $hash_string, $hash_string2);
        //发送请求
        $request = new Request();
        $request->sendCurlPostData($url, $data, $headers);
    }




}