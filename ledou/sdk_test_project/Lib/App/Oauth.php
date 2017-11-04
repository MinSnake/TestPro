<?php

namespace Lib\App;

use Lib\Log\Log;

class Oauth
{

    public function createHeaders($head, $hash_string, $hash_string2)
    {
        Log::log('正在创建请求头数据......');
        $head_test_str = '';
        foreach ($head as $key => $val) {
            $head_test_str .= $key . '=' . '"' . $val . '",';
        }
        $head_test_str = 'OAuth ' . $head_test_str;
        $head_test_str = substr($head_test_str, 0, -1);
        $headers_test = array(
            'Authorization' => $head_test_str
        );
        $temp = 'Authorization: ' . $headers_test['Authorization'] .
            ',oauth_signature="' . urlencode($hash_string) .
            '",oauth_signature_v2="' . urlencode($hash_string2) . '"';
        Log::log('【生成请求头数据结果】：');
        Log::log($temp);
        $headers = array(
            $temp
        );
        return $headers;
    }

    /**
     * @todo 加密Hash
     *
     * @param $base_string
     * @param $game_secret
     * @param $token_secret
     * @return string
     */
    public function hashsign($base_string, $game_secret, $token_secret)
    {
        Log::log('正在生成加密的Hash字符串......');
        $key_parts = array(
            $game_secret,
            $token_secret ? $token_secret : ""
        );
        $key_parts = self::urlencode_rfc3986($key_parts);
        $key = implode('&', $key_parts);


        Log::log('加密key:' . $key);
        Log::log('加密原串:' . $base_string);
        $temp_1 = hash_hmac('sha1', $base_string, $key, true);
        $string = base64_encode($temp_1);
        Log::log('【生成加密后的hash字符串】:' . $string);
        return $string;
    }


    function convertUrlQuery($query)
    {
        $queryParts = explode('&', $query);
        $params = array();
        foreach ($queryParts as $param) {
            $item = explode('=', $param);
            $params[$item[0]] = $item[1];
        }
        return $params;
    }

    function par_url($url)
    {
        $arr = parse_url($url);
        //var_dump($arr);
        if (isset($arr['port'])) {
            $api = $arr['scheme'] . '://' . $arr['host'] . ':' . $arr['port'] . $arr['path'];
        } else {
            $api = $arr['scheme'] . '://' . $arr['host'] . ':80' . $arr['path'];
        }
        if (isset($arr['query'])) {
            $arr_query = $this->convertUrlQuery($arr['query']);
        } else {
            $arr_query = "";
        }
        return array('url' => $api, 'query' => $arr_query);
    }

    function base_string($http_method, $http_url, $authorization, $par = '')
    {
        $params = $this->par_url($http_url);
        if ($params) {
            if (isset($params['query']) && !empty($params['query'])) {
                $arr = array_merge($authorization, $params['query']);
            }
            $arr = $authorization;
        }
        if ($par) {
            $arr = array_merge($authorization, $par);
        }
        //按照键名进行升序排序
        ksort($arr);
        Log::log('排序后的DATA数据：' . var_export($arr, true));
        foreach ($arr as $key => $value) {
            $a[] = $key . '=' . urlencode($value);

        }
        //用&符号连起来
        $querySBS = join('&', $a);
        $parts = array(
            $http_method,
            $http_url,
            $querySBS
        );
        //根据RFC3986进行编码转换
        $keyparts = self::urlencode_rfc3986($parts);
        $base_string = implode('&', $keyparts);
        return $base_string;
    }


    public static function urlencode_rfc3986($input)
    {
        if (is_array($input)) {
            return array_map(array('Lib\App\Oauth', 'urlencode_rfc3986'), $input);
        } else if (is_scalar($input)) {
            return str_replace(
                '+',
                ' ',
                str_replace('%7E', '~', rawurlencode($input))
            );
        } else {
            return '';
        }
    }

}