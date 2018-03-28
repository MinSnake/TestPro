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


$client = new swoole_client(SWOOLE_SOCK_TCP);
if (!$client->connect('127.0.0.1', 9801, -1)) {
    exit("connect failed. Error: {$client->errCode}\n");
}
$nsq->subscribe($nsq_lookupd, $config, function ($msg, $bev) use ($client) {
    logx('');
    logx('------------------------------------------------------');
    logx('');
    logx('接收到$msg：  ' . var_export($msg, true));
    $data = $msg->payload . PHP_EOL;
    $client->send($data);
    $client->close();
    return;
});
