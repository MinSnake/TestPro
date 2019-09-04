<?php

$redis = new Redis();
$redis->connect('127.0.0.1', 6379);

$result = $redis->zRank('user:list', 537600);

echo '排名： ' . ($result + 1);