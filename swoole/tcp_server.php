<?php


//创建Server对象，监听 127.0.0.1:9501端口
$server = new \Swoole\Server("0.0.0.0", 9501);

//监听连接进入事件
$server->on('connect', function ($serv, $fd) {
    echo "Client: Connect.\n";
});

//监听数据接收事件
$server->on('receive', function (\Swoole\Server $serv, $fd, $from_id, $data) {

    echo "接收到客户端ID： $fd (来自线程 [$from_id] )的请求数据：$data" . PHP_EOL;

    if ($data == 'get name')
    {
        $serv->send($fd, "saki");
    }
    else
    {
        $serv->send($fd, "fail");
    }


});

//监听连接关闭事件
$server->on('close', function ($serv, $fd) {
    echo "Client: Close.\n";
});


$server->on('start', function (){
    echo 'server start' . PHP_EOL;
});

//启动服务器
$server->start();