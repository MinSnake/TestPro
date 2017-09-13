<?php
/**
 * @todo Fortumo Android SDK Payment Test Project
 *
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
    echolog('接收到GET参数：' . var_export($params, true));


}
else
{
    echolog('GET请求参数为空，即将返回403');
    header("HTTP/1.0 403 Forbidden");
    die("Error: Unknown Request");
}



































