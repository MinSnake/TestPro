<?php
/**
 * $serv = new swoole_server(string $host, int $port, int $mode = SWOOLE_PROCESS, int $sock_type = SWOOLE_SOCK_TCP);
 */

$server = new swoole_server("0.0.0.0", 9505, SWOOLE_BASE , SWOOLE_SOCK_TCP);

$server->set(
    array(
        //业务代码为同步阻塞，需要根据请求响应时间和系统负载来调整
        'worker_num' => 1,
        //task进程是同步阻塞的，配置方式与worker同步模式一致。
        //务必要注册onTask/onFinish2个事件回调函数
        'task_worker_num' => 3,
        //设置task进程与worker进程之间通信的方式。
        //1, 使用unix socket通信，默认模式
        //2, 使用消息队列通信
        //3, 使用消息队列通信，并设置为争抢模式(将无法使用定向投递)
        'task_ipc_mode' => 2,

        //守护进程化
//        'daemonize' => 1,
    )
);

//
/**
 * swoole_server->on(string $event, mixed $callback);
 *
 * 第1个参数是回调的名称, 大小写不敏感，具体内容参考回调函数列表，事件名称字符串不要加on
 * 第2个函数是回调的PHP函数，可以是函数名的字符串，类静态方法，对象方法数组，匿名函数。
 *
 * 在此事件之前Swoole Server已进行了如下操作

 * 已创建了manager进程
 * 已创建了worker子进程
 * 已监听所有TCP/UDP端口
 * 已监听了定时器

 * 接下来要执行

 * 主Reactor开始接收事件，客户端可以connect到Server
 *
 * 在onStart中创建的全局资源对象不能在worker进程中被使用，
 * 因为发生onStart调用时，worker进程已经创建好了。
 */

$server->on('Start', function (swoole_server $server){
    echo "==============启动服务中=============== \n";
    echo "Swoole服务器已经启动，当前使用版本为 [" . SWOOLE_VERSION . "]\n";
});


/**
 * function onReceive(swoole_server $server, int $fd, int $from_id, string $data);
 *
 * 接收到数据时回调此函数，发生在worker进程中。函数原型：
 */
$server->on('Receive', function (swoole_server $server, int $fd, int $from_id, string $data){
    echo "==============================" . PHP_EOL;
    echo "进入到【接受消息】进程" . PHP_EOL;
    echo "当前消息内容：" . var_export($data, true) . PHP_EOL;

    echo "即将sleep2秒后开始处理请求" . PHP_EOL;
    sleep(1);
    echo "1" . PHP_EOL;
    sleep(1);
    echo "2" . PHP_EOL;

    echo "开始处理请求" . PHP_EOL;

    $data = unserialize($data);//反序列化消息数据
    /**
     * 关于data中的数据
     * type 计算类型  1-乘法，2-加法
     * num1 数字1
     * num2 数字2
     *
     * 这个任务主要做的就是，当请求为乘法的时候由【特殊】的【任务进程】执行
     * 如果为加法的话就使用其他的【普通】的【任务进程】执行
     *
     * 如果都不满足，则返回参数错误信息。
     */

    if (isset($data['type']) && isset($data['num1']) && isset($data['num2']))
    {
        if (in_array($data['type'], array(1, 2))){
            //分配任务进程
            if ($data['type'] == 1)
            {
                $task_id = 0;
            }
            else
            {
                $task_id = rand(1, 2);
            }
            //开始做任务
            echo "开始做任务" . PHP_EOL;
            $data['task_id'] = $task_id;
            $data['fd'] = $fd;
            $data['from_id'] = $from_id;
            $task_data = serialize($data);
            $server->task($task_data, $task_id);
        }
        else
        {
            echo "请求的操作类型参数错误" . PHP_EOL;
            $server->send($fd, "请求的操作类型参数错误");
            $server->close($fd, $from_id);
            echo "数据返回结束，关闭客户端连接" . PHP_EOL;
            echo "==============================" . PHP_EOL;
        }
    }
    else
    {
        echo "请求参数错误" . PHP_EOL;
        $server->send($fd, "请求参数错误");
        $server->close($fd, $from_id);
        echo "数据返回结束，关闭客户端连接" . PHP_EOL;
        echo "==============================" . PHP_EOL;
    }
});


/**
 * 在task_worker进程内被调用。worker进程可以使用swoole_server_task函数向task_worker进程投递新的任务。
 *
 * $task_id是任务ID，由swoole扩展内自动生成，用于区分不同的任务。$task_id和$from_id组合起来才是全局唯一的，
 * 不同的worker进程投递的任务ID可能会有相同
 *
 * $from_id来自于哪个worker进程
 *
 * $data 是任务的内容
 *
 */
$server->on('Task', function (swoole_server $server, int $task_id, int $from_id, string $data){
    echo "进入到【任务处理】进程" . PHP_EOL;
    //反序列化任务数据
    $data = unserialize($data);
    echo "当前的任务进程号为：" . $data['task_id'] . PHP_EOL;

    echo "开始计算!!" . PHP_EOL;
    //开始计算
    if ($data['type'] == 1)
    {
        $result = (int)$data['num1'] * (int)$data['num2'];
    }
    else
    {
        $result = (int)$data['num1'] + (int)$data['num2'];
    }
    $return_data['result'] = $result;
    $return_data['fd'] = $data['fd'];
    $return_data['from_id'] = $data['from_id'];
    $server->finish(serialize($return_data));
});


/**
 * 【重要】只能在task进程中使用finish方法调用到此处的回调函数
 *
 * 当worker进程投递的任务在task_worker中完成时，task进程会通过swoole_server->finish()方法将任务处理的结果发送给worker进程。
 *
 * $task_id是任务的ID
 *
 * $data是任务处理的结果内容
 */
$server->on('Finish', function (swoole_server $server, int $task_id, string $data){
    echo "进入到【任务结束】进程中" . PHP_EOL;
    $data = unserialize($data);

    echo "即将返回数据：" . $data['result'] . PHP_EOL;

    $server->send($data['fd'], $data['result']);
    $server->close($data['fd'], $data['from_id']);
    echo "数据返回结束，关闭客户端连接" . PHP_EOL;
    echo "==============================" . PHP_EOL;
});

$server->start();

