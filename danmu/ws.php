<?php

$server = new Swoole\WebSocket\Server('0.0.0.0', 9508);

$server->on('start', function (Swoole\WebSocket\Server $server) {
    echo 'start!!!' . PHP_EOL;
});

$server->on('open', function (Swoole\WebSocket\Server $server, $request) {
    echo "server: handshake success with fd{$request->fd}\n";
});

$server->on('message', function (Swoole\WebSocket\Server $server, $frame) {
//    echo "receive from {$frame->fd}:{$frame->data},opcode:{$frame->opcode},fin:{$frame->finish}\n";

//    $data = json_decode($frame->data, true);
    $server->task($frame->data);
    $server->push($frame->fd, "this is server");
});

$server->on('task', function (Swoole\WebSocket\Server $server, $taskid, $fromid, $data) {
    foreach ($server->connections as $connection) {
        $server->push($connection, $data);
    }
});

$server->on('close', function ($ser, $fd) {
    echo "client {$fd} closed\n";
});

$server->start();


