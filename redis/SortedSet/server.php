<?php

$uid = $_POST['uid'];
$score = $_POST['score'];
$use_time = $_POST['use_time'];

$redis = new Redis();
$redis->connect('127.0.0.1', 6379);

$redis_key = 'user:list';
$redis_score = (100 - $score) + ($use_time / $score);
//$redis_value = json_encode([
//    'uid' => $uid,
//    'score' => $score,
//    'use_time' => $use_time
//]);
$redis->zAdd($redis_key, $redis_score, $uid);
echo 'ok';
