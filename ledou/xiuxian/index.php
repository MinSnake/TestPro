<?php
/**
 * 加载配置文件
 */
require 'config.php';
require 'Util/RequestUtil.php';
require 'Util/OAuthUtil.php';
require 'Util/Log.php';
use Util\RequestUtil;
use Util\OAuthUtil;
use Util\Log;

/**
 * @todo 休闲用户第一步  请求oauth/request_token
 */
function oauth_request_token()
{
    Log::log('');
    Log::log('====正在请求【secure】接口【oauth/request_token】====');
    $start_time = time();
    $result = false;
    $oauth_request_token_config = REQUEST_CONFIG['secure']['oauth/request_token'];
    $url = $oauth_request_token_config['url'];
    $sign_url = $oauth_request_token_config['sign_url'];
    $data = $oauth_request_token_config['data'];
    $method = $oauth_request_token_config['method'];
    $head = REQUEST_CONFIG['common_headers'];
    $oauthUtil = new OAuthUtil();
    $base_string = $oauthUtil->base_string('POST', $sign_url, $head, array());
    $hash_string = $oauthUtil->hashsign($base_string, GAME_CONFIG['secret'], '');
    $headers = $oauthUtil->createHeaders($head, $hash_string);
    $requestUtil = new RequestUtil();
    if ($method == 'POST')
    {
        $result = $requestUtil->sendCurlPostData($url, $data, $headers);
    }
    Log::log('请求结果:');
    Log::log($result);

    $requestUtil->saveOauthRequestToken($result);

    $end_time = time();
    $use_time = $end_time - $start_time;
    Log::log('====【请求一共耗时' . $use_time . '秒】====');
    Log::log('====【secure】接口【oauth/request_token】请求结束====');
    Log::log('');
}

/**
 * @todo 休闲用户登录第二步  请求oauth/authenticate
 */
function oauth_authenticate()
{
    Log::log('');
    Log::log('====正在请求【secure】接口【oauth/authenticate】====');
    $start_time = time(); //开始运行的时间


    $oauth_authenticate_config = REQUEST_CONFIG['secure']['oauth/authenticate'];
    $data = $oauth_authenticate_config['data'];
    $data['oauth_token'] = TOKEN_CONFIG['key'];
    $url = $oauth_authenticate_config['url'];
    $sign_url = $oauth_authenticate_config['sign_url'];
    $method = $oauth_authenticate_config['method'];
    $head = REQUEST_CONFIG['common_headers'];
    $oauthUtil = new OAuthUtil();
    $base_string = $oauthUtil->base_string('POST', $sign_url, $head, array());
    $hash_string = $oauthUtil->hashsign($base_string, GAME_CONFIG['secret'], '');
    $headers = $oauthUtil->createHeaders($head, $hash_string);
    $requestUtil = new RequestUtil();
    if ($method == 'POST')
    {
        $requestUtil->sendCurlPostData($url, $data, $headers);
    }
    $end_time = time();
    $use_time = $end_time - $start_time;
    Log::log('====【请求一共耗时' . $use_time . '秒】====');
    Log::log('====【secure】接口【oauth/authenticate】请求结束====');
    Log::log('');
}




oauth_request_token();

oauth_authenticate();







