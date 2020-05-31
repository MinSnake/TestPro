<?php
const SEND_MSG_LOGIN = "type@=loginreq/roomid@=:msg/\0";
const SEND_MSG_JOIN_ROOM = "type@=joingroup/rid@=:msg/gid@=-1/\0";
const SEND_MSG_KEEP_LIVE = "type@=mrkl/\0";


//斗鱼原类型
const SPBC        = 'spbc';
const CHATMSG     = 'chatmsg';
const UENTER      = 'uenter';
const SRRES       = 'srres';
const UPGRADE     = 'upgrade';
const SSD         = 'ssd';
const NEWBLACKRES = 'newblackres';

//自定义类型
const TYPE_GIFT           = 'gift';
const TYPE_CHAT_MSG       = 'chat_msg';
const TYPE_USER_ENTER     = 'user_enter';
const TYPE_SHARE_ROOM     = 'share_room';
const TYPE_USER_LEVEL_UP  = 'user_level_up';
const TYPE_SUPER_CHAT_MSG = 'super_chat_msg';
const TYPE_BANNED         = 'banned';
const TYPE_ERROR          = 'error';

//格式化消息
const TAG_YELLOW = "<fg=yellow>:message</>";
//青色
const TAG_CYAN  = "<fg=cyan>:message</>";
const TAG_BLUE  = "<fg=blue>:message</>";
const TAG_GREEN = "<fg=green>:message</>";
const TAG_RED   = "<fg=red>:message</>";
//品红
const TAG_MAGENTA = "<fg=magenta>:message</>";
const TAG_ERROR   = "<fg=cyan;options=blink>:message</>";

function packMsg($str, $params = '')
{
    $msg = str_replace(':msg', $params, $str);
    $length = pack('V', 4 + 4 + strlen($msg) + 1);
    $code = $length;
    $magic = chr(0xb1) . chr(0x02) . chr(0x00) . chr(0x00);
    $end = chr(0x00);
    return $length . $code . $magic . $msg . $end;
}

function unpackMsg($msg)
{
    preg_match('/type@=(.*?)\//', $msg, $match);
    $type = $match[1] ?? '';
    if (empty($type)) {
        return null;
    }
    $result = [];

    switch ($type) {
        //礼物广播
        case SPBC:
            preg_match('/\/sn@=(.*?)\/dn@=(.*?)\/gn@=(.*?)\/gc@=(.*?)\//', $msg, $matches);
            $from            = $matches[1] ?? '';
            $to              = $matches[2] ?? '';
            $gift            = $matches[3] ?? '';
            $giftNum         = $matches[4] ?? '';
            $result['type']  = TYPE_GIFT;
            $result['msg'][] = '[' . $from . '] 送给了 [' . $to . '] ' . $giftNum . '个' . $gift;
            break;
        //弹幕消息
        case CHATMSG:
            preg_match_all('/\/nn@=([^\/]*?)\/txt@=([^\/]*?)\//', $msg, $matches, PREG_SET_ORDER);
            $result['type'] = TYPE_CHAT_MSG;
            foreach ($matches as $item) {
                $name            = $item[1] ?? '';
                $text            = $item[2] ?? '';
                $result['msg'][] = '[' . $name . ']: ' . $text;
            }
            break;
        //用户进入房间
        case UENTER:
            preg_match('/\/nn@=(.*?)\//', $msg, $matches);
            $name            = $matches[1] ?? '';
            $result['type']  = TYPE_USER_ENTER;
            $result['msg'][] = '[' . $name . '] 进入房间';
            break;
        //分享房间
        case SRRES:
            preg_match('/\/nickname@=(.*?)\//', $msg, $matches);
            $name            = $matches[1] ?? '';
            $result['type']  = TYPE_SHARE_ROOM;
            $result['msg'][] = '[' . $name . '] 分享了直播间';
            break;
        //用户等级提升
        case UPGRADE:
            preg_match('/\/nn@=(.*?)\/level@=(.*?)\//', $msg, $matches);
            $name            = $matches[1] ?? '';
            $level           = $matches[2] ?? '';
            $result['type']  = TYPE_USER_LEVEL_UP;
            $result['msg'][] = '恭喜 [' . $name . '] 升级到' . $level;
            break;
        //超级弹幕
        case SSD:
            preg_match('/\/content@=(.*?)\//', $msg, $matches);
            $content         = $matches[1] ?? '';
            $result['type']  = TYPE_SUPER_CHAT_MSG;
            $result['msg'][] = '超级弹幕 ' . $content;
            break;
        //禁言
        case NEWBLACKRES:
            preg_match('/\/snic@=(.*?)\/dnic@=(.*?)\//', $msg, $matches);
            $user1           = $matches[1] ?? '';
            $user2           = $matches[2] ?? '';
            $result['type']  = TYPE_BANNED;
            $result['msg'][] = '[' . $user1 . '] 将 [' . $user2 . '] 禁言';
            break;
        //贵族广播消息
        case 'online_noble_list':
            //心跳
        case 'mrkl':
            //登录返回
        case 'loginres':
            //赠送礼物，没有返回名称，不显示
        case 'dgb':
            //广播排行榜消息
        case 'ranklist':
            //房间内 top10 变化消息
        case 'rankup':
            //栏目排行榜变更通知
        case 'rri':

            //未知
        case 'pingreq':
        case 'noble_num_info':
        case 'rnewbc':
        case 'bgbc':
        case 'synexp':
        case 'qausrespond':
        case 'gbroadcast':
        case 'anbc':
        case 'rwdbc':
        case 'lgpoolsite':
        case 'blab':
        case 'fswrank':
        case 'cthn':
        case 'wirt':
        case 'rquizisn':
        case 'tsgs':
        case 'rquiziln':
        case 'tkrquizisn':
            break;

        default:
//            if (Config::get('debug') == TRUE) {
            $result['type']  = TYPE_ERROR;
            $result['msg'][] = '原始数据: ' . $msg;
//            }
    }

//    if (Config::get('show_color')) {
//        return styleMessage($result);
//    }
    return $result;
}

function styleMessage($msgResult) {
    if (!isset($msgResult['type'])) return $msgResult;

    switch ($msgResult['type']) {

        case TYPE_GIFT:
        case TYPE_USER_LEVEL_UP:
        case TYPE_SUPER_CHAT_MSG:
        case TYPE_BANNED:
            array_walk($msgResult['msg'], function (&$msg) {
                $msg = str_replace(':message', $msg, TAG_RED);
            });
            break;
        case TYPE_CHAT_MSG:
            array_walk($msgResult['msg'], function (&$msg) {
                $msg = str_replace(':message', $msg, TAG_MAGENTA);
            });
            break;
        case TYPE_USER_ENTER:
            array_walk($msgResult['msg'], function (&$msg) {
                $msg = str_replace(':message', $msg, TAG_YELLOW);
            });
            break;
        case TYPE_SHARE_ROOM:
            array_walk($msgResult['msg'], function (&$msg) {
                $msg = str_replace(':message', $msg, TAG_BLUE);
            });
            break;
        case TYPE_ERROR:
            array_walk($msgResult['msg'], function (&$msg) {
                $msg = str_replace(':message', $msg, TAG_ERROR);
            });
            break;
    }

    return $msgResult;
}

Co\run(function () {
    $port = 8502;
    $roomId = 9999;
    $client = new Swoole\Coroutine\Http\Client("danmuproxy.douyu.com", $port, true);
    $ret = $client->upgrade("/");
    if ($ret) {
        $client->push(packMsg(SEND_MSG_LOGIN, $roomId));
        $client->push(packMsg(SEND_MSG_JOIN_ROOM, $roomId));
        \Swoole\Timer::tick(45000, function (int $timer_id, $c){
            $c->push(packMsg(SEND_MSG_KEEP_LIVE));
            echo "---------发送了一次心跳包---------\n";
        }, $client);
        echo "start \n";
        while (true) {
            $result = $client->recv();
            if ($result && $result->finish) {
                $receiveResult        = unpackMsg($result->data);
                if ($receiveResult && $receiveResult['type'] === "chat_msg") {
                    echo $receiveResult["msg"][0] . PHP_EOL;
                }
            }
        }

    }
});


