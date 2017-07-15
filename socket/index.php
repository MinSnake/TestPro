<?php
set_time_limit(0);

$ip = '127.0.0.1';
$port = 1935;

/**
 * resource socket_create ( int $domain , int $type , int $protocol )
 *
 * 官方文档
 * http://php.net/manual/zh/function.socket-create.php
 *
 * 创建并返回一个套接字，也称作一个通讯节点。一个典型的网络连接由 2 个套接字构成，一个运行在客户端，另一个运行在服务器端。
 *
 * $domain 参数指定哪个协议用在当前套接字上。
 *     AF_INET    IPv4 网络协议。TCP 和 UDP 都可使用此协议。
 *     AF_INET6   IPv6 网络协议。TCP 和 UDP 都可使用此协议。
 *     AF_UNIX    本地通讯协议。具有高性能和低成本的 IPC（进程间通讯）。
 *
 * $type 参数用于选择套接字使用的类型
 *     SOCK_STREAM    提供一个顺序化的、可靠的、全双工的、基于连接的字节流。支持数据传送流量控制机制。TCP 协议即基于这种流式套接字。
 *
 * $protocol 是设置指定 domain 套接字下的具体协议。这个值可以使用 getprotobyname() 函数进行读取。
 *           如果所需的协议是 TCP 或 UDP，可以直接使用常量 SOL_TCP 和 SOL_UDP 。
 *
 * 关于返回值
 *
 * 正确时返回一个套接字，失败时返回 FALSE
 * 要读取错误代码，可以调用 socket_last_error()。
 * 这个错误代码可以通过 socket_strerror() 读取文字的错误说明。
 *
 */
if(($sock = socket_create(AF_INET, SOCK_STREAM, SOL_TCP)) === false)
{
    echo "socket_create() 失败的原因是:".socket_strerror($sock) . PHP_EOL;
}


/**
 * bool socket_bind ( resource $socket , string $address [, int $port = 0 ] )
 *
 * 官方文档
 * http://php.net/manual/zh/function.socket-bind.php
 *
 * 绑定 address 到 socket。 该操作必须是在使用 socket_connect() 或者 socket_listen() 建立一个连接之前。
 *
 * $socket    用 socket_create() 创建的一个有效的套接字资源。
 *
 * $address   如果套接字是 AF_INET 族，那么 address 必须是一个四点分法的 IP 地址（例如 127.0.0.1 ）。
 *            如果套接字是 AF_UNIX 族，那么 address 是 Unix 套接字一部分（例如 /tmp/my.sock ）。
 *
 * $port （可选） 仅仅用于 AF_INET 套接字连接的时候，并且指定连接中需要监听的端口号。
 *
 * 关于返回值
 *
 * 成功时返回 TRUE， 或者在失败时返回 FALSE。
 * 错误代码会传入 socket_last_error() ，如果将此参数传入 socket_strerror() 则可以得到错误的文字说明。
 *
 */
if (($ret = socket_bind($sock, $ip, $port)) === false)
{
    echo "socket_bind() 失败的原因是:" . socket_strerror($ret) . PHP_EOL;
}


/**
 * bool socket_listen ( resource $socket [, int $backlog = 0 ] )
 *
 * http://php.net/manual/zh/function.socket-listen.php
 *
 * 用来监听传过来的socket连接
 *
 */
if (($res = socket_listen($sock, 4)) === false)
{
    echo "socket_listen() 失败的原因是:" . socket_strerror($res) . PHP_EOL;
}

do {

    if (($msgsock = socket_accept($sock)) === false)
    {
        echo 'socket_accept() 失败的原因是:' . socket_strerror($msgsock) . PHP_EOL;
        break;
    }
    else
    {
        //send to client
        $msg = "test success! \n";


    }

} while(true);

