<?php

//if (isset($_POST['data']))
//{

//    $data = $_POST['data'];
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
swoole_timer_tick(1000,function($msg, $bev) {
    echo "aaaaaa\n\n";
});
$data = 'asdasd';
$client = new \Swoole\Http\Client('127.0.0.1', 9508);

$client->on('message', function ($_cli, $frame) {
//    var_dump($frame);
    //global $nsq_lookupd, $nsq, $config;
    //$nsq->subscribe($nsq_lookupd, $config, test);
});

$client->upgrade('/', function ($client) {
    //global $data;
    echo $client->body;
    //$client->push($data);

});



//$client->push($data);
//    $client->close();
//echo 'ok';
//}
//else
//{
//    echo 'faixxxl';
//}

