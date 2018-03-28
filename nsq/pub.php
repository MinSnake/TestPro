<?php
//nsqd - TCP - 4150

//$nickname = $_POST['nickname'];
//$avatar = $_POST['avatar'];
//$content = $_POST['content'];
//
//$data = array(
//    'nickname' => $nickname,
//    'avatar' => $avatar,
//    'content' => $content,
//);

$data = array(
    'nickname' => 11,
    'avatar' => 22,
    'content' => 33,
);

$nsqdAddr = array(
    "127.0.0.1:4150"
);
$nsq = new Nsq();
$isTrue = $nsq->connectNsqd($nsqdAddr);
$msg = json_encode($data);
$nsq->publish("weplay", $msg);
$nsq->closeNsqdConnection();

//推迟发布
//Deferred publish
//function : deferredPublish(string topic,string message, int millisecond);
//millisecond default : [0 < millisecond < 3600000]

//$deferred = new Nsq();
//$isTrue = $deferred->connectNsqd($nsqdAddr);
//for($i = 0; $i < 20; $i++){
//    $deferred->deferredPublish("test", "message daly", 3000);
//}
//$deferred->closeNsqdConnection();