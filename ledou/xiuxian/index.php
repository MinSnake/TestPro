<?php
/**
 * 加载配置文件
 */
require 'config.php';
require 'Util/RequestUtil.php';
require 'Util/OAuthUtil.php';
require 'Util/Log.php';
require 'Util/ToolUtil.php';
use Util\RequestUtil;
use Util\OAuthUtil;
use Util\Log;
use Util\ToolUtil;

/**
 * @todo 休闲用户第一步  请求oauth/request_token
 */
function oauth_request_token()
{
    Log::log('');
    Log::log('====正在请求【secure】接口【oauth/request_token】====');
    $start_time = ToolUtil::getMillisecond();
    $result = false;
    $oauth_request_token_config = REQUEST_CONFIG['secure']['oauth/request_token'];
    $url = $oauth_request_token_config['url'];
    $sign_url = $oauth_request_token_config['sign_url'];
    $data = $oauth_request_token_config['data'];
    $method = $oauth_request_token_config['method'];
    $head = REQUEST_CONFIG['common_headers'];
    $oauthUtil = new OAuthUtil();
    $base_string = $oauthUtil->base_string($method, $sign_url, $head, array());
    $hash_string = $oauthUtil->hashsign($base_string, GAME_CONFIG['secret'], '');
    $headers = $oauthUtil->createHeaders($head, $hash_string, $hash_string);
    $requestUtil = new RequestUtil();
    if ($method == 'POST')
    {
        $result = $requestUtil->sendCurlPostData($url, $data, $headers);
    }
    $requestUtil->saveOauthRequestToken($result);
    $end_time = ToolUtil::getMillisecond();
    $use_time = $end_time - $start_time;
    Log::log('====【请求一共耗时' . $use_time . '毫秒】====');
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
    $start_time = ToolUtil::getMillisecond();
    $oauth_authenticate_config = REQUEST_CONFIG['secure']['oauth/authenticate'];
    $data = $oauth_authenticate_config['data'];
    $data['oauth_token'] = TOKEN_CONFIG['key'];
    $url = $oauth_authenticate_config['url'];
    $sign_url = $oauth_authenticate_config['sign_url'];
    $method = $oauth_authenticate_config['method'];
    $head = REQUEST_CONFIG['common_headers'];
    $oauthUtil = new OAuthUtil();
    $base_string = $oauthUtil->base_string($method, $sign_url, $head, array());
    $hash_string = $oauthUtil->hashsign($base_string, GAME_CONFIG['secret'], TOKEN_CONFIG['secret']);
    $headers = $oauthUtil->createHeaders($head, $hash_string, $hash_string);
    $requestUtil = new RequestUtil();
    if ($method == 'POST')
    {
        $requestUtil->sendCurlPostData($url, $data, $headers);
    }
    $end_time = ToolUtil::getMillisecond();
    $use_time = $end_time - $start_time;
    Log::log('====【请求一共耗时' . $use_time . '毫秒】====');
    Log::log('====【secure】接口【oauth/authenticate】请求结束====');
    Log::log('');
}

//https://asia-secure.ldoverseas.com:443/oauth/access_token
function oauth_access_token()
{
    Log::log('');
    Log::log('====正在请求【secure】接口【oauth/access_token】====');
    $start_time = ToolUtil::getMillisecond();
    $oauth_authenticate_config = REQUEST_CONFIG['secure']['oauth/access_token'];
    $data = $oauth_authenticate_config['data'];
    $url = $oauth_authenticate_config['url'];
    $sign_url = $oauth_authenticate_config['sign_url'];
    $method = $oauth_authenticate_config['method'];
    $head = REQUEST_CONFIG['common_headers'];
    $head['oauth_token'] = TOKEN_CONFIG['key'];
    $oauthUtil = new OAuthUtil();
    $base_string = $oauthUtil->base_string($method, $sign_url, $head, array());
    $hash_string = $oauthUtil->hashsign($base_string, GAME_CONFIG['secret'], TOKEN_CONFIG['secret']);
    $headers = $oauthUtil->createHeaders($head, $hash_string, $hash_string);
    $requestUtil = new RequestUtil();
    if ($method == 'POST')
    {
        $requestUtil->sendCurlPostData($url, $data, $headers);
    }
    $end_time = ToolUtil::getMillisecond();
    $use_time = $end_time - $start_time;
    Log::log('====【请求一共耗时' . $use_time . '毫秒】====');
    Log::log('====【secure】接口【oauth/access_token】请求结束====');
    Log::log('');
}


function account_verify_credentials()
{
    Log::log('');
    Log::log('====正在请求【feed】接口【account/verify_credentials】====');
    $start_time = ToolUtil::getMillisecond();
    $account_verify_credentials_config = REQUEST_CONFIG['feed']['account/verify_credentials'];
    $data = $account_verify_credentials_config['data'];
    $method = $account_verify_credentials_config['method'];
    $url = $account_verify_credentials_config['url'];
    $sign_url = $account_verify_credentials_config['sign_url'];
    $head = REQUEST_CONFIG['common_headers'];
    $head['oauth_token'] = TOKEN_CONFIG['key'];
    $oauthUtil = new OAuthUtil();
    $base_string = $oauthUtil->base_string($method, $sign_url, $head, array());
    $hash_string = $oauthUtil->hashsign($base_string, GAME_CONFIG['secret'], TOKEN_CONFIG['secret']);
    $base_string2 = $oauthUtil->base_string($method, $sign_url, $head, $data);
    $hash_string2 = $oauthUtil->hashsign($base_string2, GAME_CONFIG['secret'], TOKEN_CONFIG['secret']);
    $headers = $oauthUtil->createHeaders($head, $hash_string, $hash_string2);
    $requestUtil = new RequestUtil();
    $requestUtil->sendCurlGet($url, $data, $headers);
    $end_time = ToolUtil::getMillisecond();
    $use_time = $end_time - $start_time;
    Log::log('====【请求一共耗时' . $use_time . '毫秒】====');
    Log::log('====【secure】接口【account/verify_credentials】请求结束====');
    Log::log('');
}


function payments_create()
{
    Log::log('');
    Log::log('====正在请求【pay】接口【payments/create】====');
    $start_time = ToolUtil::getMillisecond();
    //开始处理创建订单流程
    $payments_create_config = REQUEST_CONFIG['pay']['payments/create'];
    $data = $payments_create_config['data'];
    $method = $payments_create_config['method'];
    $url = $payments_create_config['url'];
    $sign_url = $payments_create_config['sign_url'];
    $head = REQUEST_CONFIG['common_headers'];
    $head['oauth_token'] = TOKEN_CONFIG['key'];
    $oauthUtil = new OAuthUtil();
    $base_string = $oauthUtil->base_string($method, $sign_url, $head, array());
    $hash_string = $oauthUtil->hashsign($base_string, GAME_CONFIG['secret'], TOKEN_CONFIG['secret']);
    $base_string2 = $oauthUtil->base_string($method, $sign_url, $head, $data);
    $hash_string2 = $oauthUtil->hashsign($base_string2, GAME_CONFIG['secret'], TOKEN_CONFIG['secret']);
    $headers = $oauthUtil->createHeaders($head, $hash_string, $hash_string2);
    $requestUtil = new RequestUtil();
    $requestUtil->sendCurlPostData($url, $data, $headers);
    //创建订单流程结束
    $end_time = ToolUtil::getMillisecond();
    $use_time = $end_time - $start_time;
    Log::log('====【请求一共耗时' . $use_time . '毫秒】====');
    Log::log('====【pay】接口【payments/create】请求结束====');
    Log::log('');
}


oauth_request_token();
oauth_authenticate();
oauth_access_token();
account_verify_credentials();
payments_create();

