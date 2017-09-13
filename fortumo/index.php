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
    fclose($fp);  //关闭指针
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

    echo 'ok';

}
else
{
    echolog('GET请求参数为空，即将返回403');
    header("HTTP/1.0 403 Forbidden");
    die("Error: Unknown Request");
}



































