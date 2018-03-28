<?php

/**
 * 同步阻塞
 */

//$client = new swoole_client(SWOOLE_SOCK_TCP);
//if (!$client->connect('127.0.0.1', 9801, -1)) {
//    exit("connect failed. Error: {$client->errCode}\n");
//}
//$client->send("hello world\n");
//echo $client->recv();
//$client->close();


/**
 * 异步非阻塞
 */

$client = new swoole_client(SWOOLE_SOCK_TCP, SWOOLE_SOCK_ASYNC);
$client->on("connect", function (swoole_client $cli) {
//    $cli->send("GET / HTTP/1.1\r\n\r\n");
    $cli->send('OO');
});
$client->on("receive", function (swoole_client $cli, $data) {
    echo "Receive: $data";
    $cli->send(str_repeat('A', 5) . "\n");
//    sleep(1);
});
$client->on("error", function (swoole_client $cli) {
    echo "error\n";
});
$client->on("close", function (swoole_client $cli) {
    echo "Connection close\n";
});
$client->connect('127.0.0.1', 9801);


