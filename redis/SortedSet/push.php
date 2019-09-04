<?php
function send_post($url, $data)
{
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_HEADER, 1);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_POST, 1);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
    $return = curl_exec($curl);
    return $return;
}

$url = 'http://localtest.me/redis/server.php';
$data = array(
    'uid' => rand(1, 1000000),
    'score' => rand(1, 100),
    'use_time' => rand(1, 100),
);
$result = send_post($url, $data);

echo $result;




