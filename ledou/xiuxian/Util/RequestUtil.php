<?php
namespace Util;
/**
 * Created by PhpStorm.
 * User: jinda.li
 * Date: 2017/10/25
 * Time: 17:37
 */
class RequestUtil
{

    public function saveOauthRequestToken($request_result)
    {
        //oauth_token=3f4f3e0c31dbcca5d2bfa5140179b564059f08723
        //&
        //oauth_token_secret=39689ee75794aaa29f798c2be9f51da0
        $arr = explode('&', $request_result);
        $oauth_token = '';
        $oauth_token_secret = '';
        foreach ($arr as $item) {
            $temp = explode('=', $item);

            if ($temp[0] == 'oauth_token')
            {
                $oauth_token = $temp[1];
            }
            if ($temp[0] == 'oauth_token_secret')
            {
                $oauth_token_secret = $temp[1];
            }
        }
        define('TOKEN_CONFIG', array(
            'key' => $oauth_token,
            'secret' => $oauth_token_secret,
        ));
        Log::log('【token_key】' . TOKEN_CONFIG['key']);
        Log::log('【secret】' . TOKEN_CONFIG['secret']);
    }


    /**
     * @todo 发送普通的数据post请求
     * @param $url
     * @param null $data
     * @param null $head
     * @return mixed
     */
    public function sendCurlPostData($url, $data = null, $head = null)
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 10);
        if ($head) {
//            curl_setopt($curl, CURLOPT_HEADER, true);
            curl_setopt($curl, CURLOPT_HTTPHEADER, $head);
        }
        //普通数据
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
        $res = curl_exec($curl);
        curl_close($curl);
        return $res;
    }

    /**
     * @todo 发送json格式数据的curl post 请求
     *
     * @param $url
     * @param null $jsonData
     * @param null $head
     * @return mixed
     */
    public function sendCurlPostJsonData($url, $jsonData = null, $head = null)
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 120);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json', 'Content-Length:' . strlen($jsonData)));
        curl_setopt($curl, CURLOPT_POSTFIELDS, $jsonData);
        if ($head) {
            curl_setopt($curl, CURLOPT_HEADER, true);
            curl_setopt($curl, CURLOPT_HTTPHEADER, $head);
        }
        $res = curl_exec($curl);
        curl_close($curl);
        return $res;
    }


    /**
     * @todo 发送curl get 请求
     * @param $url
     * @param null $data
     * @param null $head
     * @return mixed
     */
    public function sendCurlGet($url, $data = null, $head = null)
    {
        if (is_array($data)) {
            $url .= '?';
            foreach ($data as $key => $value) {
                $url .= $key . '' . $value . '&';
            }
        }
        $url = substr($url, 0, strlen($url)-1);
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_TIMEOUT, 500);
        curl_setopt($curl, CURLOPT_URL, $url);
        if ($head) {
            curl_setopt($curl, CURLOPT_HEADER, true);
            curl_setopt($curl, CURLOPT_HTTPHEADER, $head);
        }
        $res = curl_exec($curl);
        curl_close($curl);
        return $res;
    }


}