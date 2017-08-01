<?php

class OAuthSignatures
{
    protected $oauth_consumer_secret = '';
    protected $oauth_secret_key = '';


    function __construct($oauth_consumer_secret = '', $oauth_secret_key = '')
    {
        $this->oauth_consumer_secret = $oauth_consumer_secret;
        $this->oauth_secret_key = $oauth_secret_key;
    }


    /**
     * hash加密
     * @param unknown $base_string
     * @param unknown $oauth_consumer_secret
     * @param unknown $oauth_secret_key
     */
    function hashsign($base_string)
    {
     header("Content-type: text/html; charset=utf-8");

        //用来加密的字符串数组
        $key_parts = array(
            $this->oauth_consumer_secret,
            $this->oauth_secret_key ? $this->oauth_secret_key : ""
        );

//     var_dump($key_parts);

        $key_parts = OAuthUtil::urlencode_rfc3986($key_parts);

//     var_dump($key_parts);

        $key = implode('&', $key_parts);

//     var_dump($key_parts);


        print '加密key' . "\n" . "</br>" . $key . "\n" . "</br>";

        print '加密源串    ' . "\n" . "</br>" . $base_string . "\n" . "</br>";


        $temp_1 = hash_hmac('sha1', $base_string, $key, true);

//     echo 'sha1结果:';
//     var_dump($temp_1);

//     echo 'base64结果：';
//     $temp_2 = base64_encode($temp_1);
//     var_dump($temp_2);


        $string = base64_encode(hash_hmac('sha1', $base_string, $key, true));
        return $string;
    }


}


class Fetch_request_token
{

    /**
     * 组装签名的字符串
     * @param unknown $http_method
     * @param unknown $http_url
     * @param unknown $querySBS
     */
    function base_string($http_method, $http_url, $authorization, $par = '')
    {

//        header("Content-type: text/html; charset=utf-8");
        $params = $this->par_url($http_url);

        if ($params) {
            if (isset($params['query']) && !empty($params['query'])) {
                $arr = array_merge($authorization, $params['query']);
            }
            $arr = $authorization;
        }
        if ($par) {
            $arr = array_merge($authorization, $par);
            var_dump($arr);
        }

        //按照键名进行升序排序
        ksort($arr);
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
        $keyparts = OAuthUtil::urlencode_rfc3986($parts);
        $base_string = implode('&', $keyparts);
        return $base_string;
    }

    function get_parameter_header($data)
    {
        $heard = $data['Authorization'];//substr($data['Authorization'],20,1000);
        $arr = explode(",", $heard);;
        $arrto = array();
        foreach ($arr as $k => $value) {
            $arrs = explode("=", $value);
            if ($k == 0) {
                $arrto['oauth_consumer_key'] = str_replace('"', '', $arrs[1]);
            } else {
                $arrto[trim($arrs[0])] = str_replace('"', '', $arrs[1]);
            }
        }

        var_dump($arrto);
        unset($arrto['oauth_signature_v2']);
        unset($arrto['oauth_signature']);
        return $arrto;
    }


    /**
     * 解析url
     * @param unknown $url
     * @return multitype:string multitype:Ambigous
     */
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


    /**
     * url解析，将get请求的数据转化为数组
     * @param unknown $query
     * @return multitype:Ambigous <>
     */
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

}


/**
 * 编码\
 * @todo 将字符串转为  RFC3986 编码格式
 * 即 空格用 + 表示    ~ 用 %7E
 *
 * @author martin.sun
 */
class OAuthUtil
{
    public static function urlencode_rfc3986($input)
    {
        if (is_array($input)) {
            return array_map(array('OAuthUtil', 'urlencode_rfc3986'), $input);
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