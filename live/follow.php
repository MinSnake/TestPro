<?php
// https://www.douyu.com/betard/9999
function get_douyu_live_data($rommId) {
    $url = "https://www.douyu.com/betard/" . $rommId;
    $jsonRes = file_get_contents($url);
    $jsonRes = json_decode($jsonRes, true);
    $data = array(
        'up_name' => $jsonRes['room']['nickname'],
        'room_name' =>  $jsonRes['room']['room_name'],
        'room_id' => $rommId,
        'up_avatar' => $jsonRes['room']['avatar']['big'],
        'is_live' => $jsonRes['room']['show_status'],
        'live_time' => $jsonRes['room']['show_time']
    );
    //hot
    $webContent = file_get_contents("https://m.douyu.com/$rommId");
    $pattern = "/\"hn\":\"(\d+[.]?\d+万|\d+)\"/";
    preg_match_all($pattern, $webContent, $pat_array);
    $data['hot'] = $pat_array[1][0];
    return $data;
}

$data = [];
array_push($data, get_douyu_live_data(9999));
array_push($data, get_douyu_live_data(3484));
array_push($data, get_douyu_live_data(88660));
array_push($data, get_douyu_live_data(3507497));
array_push($data, get_douyu_live_data(52876));
array_push($data, get_douyu_live_data(307876));

var_dump($data);
