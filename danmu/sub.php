<?php
function logx($msg)
{
    $time = date('Y-m-d H:i:s', time());
    echo '[' . $time . ']' . $msg . PHP_EOL;
}

$nsq_lookupd = new NsqLookupd("127.0.0.1:4161");

$nsq = new Nsq();

$config = array(
    'topic' => 'weplay',
    'channel' => 'log',
    //rdy 是你一次要收多少条消息,默认1
    "rdy" => 2,
    //启动多少个链接消费，默认1
    "connect_num" => 1,
    //默认0，是你如果想重试这条消息 ，多长时间会再次发送过来让你消费，默认为0，callback没有正常调用，或者收到个异常消息会重试
    "retry_delay_time" => 2000,
    // 默认为true ，没有特殊要求不用管，false的话需要你手动 调用message类的finish方法去手动ack
    "auto_finish" => true,
);

// //TCP
//$client->on('message', function ($_cli, $frame) {
////    var_dump($frame);
//});
//$client->upgrade('/', function ($client) {
//    global $data;
////    echo $client->body;
//    $client->push($data);
//});

$nsq->subscribe($nsq_lookupd, $config, function ($msg, $bev) {
//    global $cli;
    $client = new swoole_http_client('192.168.115.90', 9508);


//    logx(var_export($cli, true));
//
//    $cli->on('message', function () {
//    });

//    $cli->upgrade('/', function ($cli) {
//        $cli->push('xxx');
//    });


//    logx('');
//    logx('------------------------------------------------------');
//    logx('');
//    logx('接收到$msg：  ' . var_export($msg, true));

    return;
});

