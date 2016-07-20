<?php
error_reporting(0);

//TCP类型连接，同步客户端
$client = new swoole_client(SWOOLE_SOCK_TCP, SWOOLE_SOCK_SYNC);

if (!$client->connect('127.0.0.1', 9505))
{
    exit("connect failed. Error: {$client->errCode}\n");
}

/**
 * 关于data中的数据
 * type 计算类型  1-乘法，2-加法
 * num1 数字1
 * num2 数字2
 */

$type = rand(0, 2);
$num1 = rand(1, 100);
$num2 = rand(1, 100);

$data = array(
    'type' => $type,
    'num1' => $num1,
    'num2' => $num2,
);

echo "当前数据：";

var_dump($data);

$is_send = $client->send(serialize($data));

if ($is_send !== false){
    //发送成功
    while (true){
        $returnData = $client->recv($size = 65535, true);
        if ($returnData){
            $client->close();
            break;
        }
    }
    echo "获取到返回结果:" . $returnData;

    $data['result'] = $returnData;
    write_log($data);

}
else
{
    echo "请求失败！";
}


function write_log($log_data){
    $content = "请求数据及返回结果：" . var_export($log_data, true) . PHP_EOL;
    file_put_contents('log.txt', $content, FILE_APPEND);
}






