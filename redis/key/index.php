<?php
require_once '../TestRedis.php';

$testRedis = new TestRedis();
$redis = $testRedis->getTestRedis();


/**
 * Redis 键命令用于管理 redis 的键
 */



$redis->set('test_key', '123456');



/**
 * 1.DEL
 * DEL 命令用于删除已存在的键。不存在的 key 会被忽略。
 *
 * 语法：
 * redis 127.0.0.1:6379> DEL KEY_NAME
 *
 * 返回值：
 * 被删除 key 的数量。
 */

$redis->del('');






























