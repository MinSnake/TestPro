<?php
/**
 * @todo Fortumo Android SDK Payment Test Project
 *
 * Service ID:	            a81a8e0de31292b1d1c951a288192697
 * In-application secret:	e3fb69499d2ff3e37de0f4964c2dc433
 * Secret:	                0c91ddd3f15b9228184c874da0a92083
 * @author jinda.li
 * @date 2017年9月13日15:41:59
 */

function echolog($content)
{
    $filename = 'fortumo.log';
    $fp=fopen($filename, "a+");
    if ( !is_writable($filename) ){
        die("文件:" .$filename. "不可写，请检查！");
    }
    file_put_contents ($filename, $content."\n", FILE_APPEND);
    fclose($fp); 
}


function curl_send_get($url)
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_POST, false);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_REFERER, $url);
    curl_setopt($ch, CURLOPT_HEADER, false);
    $result = curl_exec($ch);
    curl_close($ch);
    return $result;
}

echolog('');
echolog('==============' . date('Y-m-d H:i:s') . '=====================');

//1.接收到GET请求参数
$params = $_GET;
if ($params)
{
    $ip = $_SERVER["REMOTE_ADDR"];

    echolog('获取到请求IP:' . $ip);
    echolog('接收到GET参数：' . var_export($params, true));


    //转发到228测试服务器

    /**
     * http://test.zzz.in1.feed.ids111.com:91/fortumo/callback?
     * billing_type=DCB&
     * confirmation_code&
     * country=TW&
     * currency=TWD&
     * keyword&
     * message_id=f61d9d1283a2d456254e544997e2101e&
     * operator=China Mobile&
     * payment_code=1505292720994a3&
     * price=5.0&
     * price_wo_vat=4.76&
     * product_name=gamerId_level2&
     * sender&service_id=a81a8e0de31292b1d1c951a288192697&
     * shortcode&
     * sig=0ced2fe628b9c72173467bac1fa79db2&
     * status=OK&
     * test=true&
     * user_id=460025000498114&
     * user_share=0
     */
    $url = 'http://test.zzz.in1.feed.ids111.com:91/fortumo/callback?';
    foreach ($params as $k=>$v) {
        if ($v !== '')
        {
            $url .= $k . '=' . $v . '&';
        }
        else
        {
            $url .= $k . '&';
        }
    }
    $url = substr($url,0,strlen($url)-1);

    echolog($url);

    $res = curl_send_get($url);

    echolog('转发请求的返回值：' . json_decode($res));


    echo 'ok';

}
else
{
    echolog('GET请求参数为空，即将返回403');
    header("HTTP/1.0 403 Forbidden");
    die("Error: Unknown Request");
}


