<?php

$server = new \Swoole\WebSocket\Server("127.0.0.1", 9905);


$server->on("open", function ($server, $req) {
    echo "打开连接，{$req->fd}" . PHP_EOL;
});

$server->on("message", function ($server, $frame) {
    echo "收到消息：{$frame->data}" . PHP_EOL;
    $server->push($frame->fd, json_encode(["hello", "world"]));
});

$server->on("close", function ($server, $fd) {
    echo "连接关闭: {$fd}" . PHP_EOL;
});

$server->start();
