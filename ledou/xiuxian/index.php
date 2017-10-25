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


oauth_request_token();
oauth_authenticate();
oauth_access_token();
account_verify_credentials();

$ss = '%7B%22product_id%22%3A%2244%22%2C%22discount%22%3A1%2C%22recharge%22%3A%221.0%22%2C%22charge_amount%22%3A%22US%240.99%22%2C%22server_id%22%3Anull%2C%22paymethod%22%3A%22156%22%2C%22paymentstate%22%3A%221%22%2C%22extral_info%22%3Anull%2C%22quantity%22%3A1%2C%22auth_game_type%22%3A%222%22%2C%22price%22%3A%221.0%22%2C%22nudid%22%3A%2221s51s7s1666938_4133082852qpqr1nq%22%2C%22channel_id%22%3A%22TEST0000000%22%2C%22udid%22%3A%2200000000-41f2-376c-f9db-9d371fcaf9a3%22%2C%22currency%22%3A%22USD%22%2C%22cli_ver%22%3A%22pay-3.2.2.14%22%2C%22type%22%3A%222%22%7D';

echo urldecode($ss);

/**
 * {
 * "product_id":"44",
 * "discount":1,
 * "recharge":"1.0",
 * "charge_amount":"US$0.99",
 * "server_id":null,
 * "paymethod":"156",
 * "paymentstate":"1",
 * "extral_info":null,
 * "quantity":1,
 * "auth_game_type":"2",
 * "price":"1.0",
 * "nudid":"21s51s7s1666938_4133082852qpqr1nq",
 * "channel_id":"TEST0000000",
 * "udid":"00000000-41f2-376c-f9db-9d371fcaf9a3",
 * "currency":"USD",
 * "cli_ver":"pay-3.2.2.14",
 * "type":"2"
 * }
 *
 *
 */




