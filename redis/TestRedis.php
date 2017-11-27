<?php

class TestRedis
{

    private $test_redis;

    function __construct()
    {
        $this->test_redis = new Redis();
        $this->test_redis->connect('127.0.0.1', 6379);
        $this->test_redis->auth('saki123456');
    }

    public function getTestRedis()
    {
        return $this->test_redis;
    }

}