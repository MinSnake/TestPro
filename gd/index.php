<?php
ini_set('max_execution_time', '0');

function logx($msg)
{
    echo '[' . date('Y-m-d H:i:s', time()) . ']' . $msg . PHP_EOL;
}

function similar($rgb1, $rgb2, $value = 20)
{
    $r1 = ($rgb1 >> 16) & 0xFF;
    $g1 = ($rgb1 >> 8) & 0xFF;
    $b1 = $rgb1 & 0xFF;
    $r2 = ($rgb2 >> 16) & 0xFF;
    $g2 = ($rgb2 >> 8) & 0xFF;
    $b2 = $rgb2 & 0xFF;
    return abs($r1 - $r2) < $value && abs($b1 - $b2) < $value && abs($g1 - $g2) < $value;
}

/**
 * @todo �������ӵײ�����
 * @param $image
 * @param $width
 * @param $height
 * @param $player_rgb
 * @return array
 */
function get_player_xy($image, $width, $height, $player_rgb)
{
    $player_x = 0;
    $player_y = 0;
    for ($y = $height / 3 * 2; $y > $height / 3; $y--) {
        for ($x = 0; $x < $width; $x++) {
            $rgb = imagecolorat($image, $x, $y);
            if (similar($rgb, $player_rgb)) {
                $player_x = $x;
                $player_y = $y;
                break 2;
            }
        }
    }
    logx('�ҵ���������: [' . $player_x . ',' . $player_y . ']');
    return [$player_x, $player_y];
}

/**
 * @todo ������һ���������
 * @param $image
 * @param $width
 * @param $height
 * @return array
 */
function get_next_xy($image, $width, $height)
{
    //ģ��������� Y������  330 - 950  X�� 0 - 1080
    $aims_x = 0;
    $aims_y = 0;
    for ($b = $height / 3; $b < $height / 3 * 2; $b++) {
        $demo = imagecolorat($image, $width - 1, $b); //�����Աȵ�����
        for ($a = 0; $a < $width; $a++) {
            $point = imagecolorat($image, $a, $b);
            if (!similar($point, $demo, 30)) {
                if (!similar($point, 3554406, 20)) {
                    $aims_x = $a;
                    $aims_y = $b + 140;
                    break 2;
                }
            }
        }
    }
    logx('�ҵ�Ŀ������: [' . $aims_x . ',' . $aims_y . ']');
    return [$aims_x, $aims_y];
}

/**
 * @todo ��ͼ���ҷŵ�������
 */
function screencap()
{
    ob_start();
    system('adb shell screencap -p /sdcard/saki_test/screen.png');
//    system('adb pull /sdcard/saki_test/screen.png /home/saki/Work/PHP/TestPro/gd/screencap/screen.png');
    system('adb pull /sdcard/saki_test/screen.png E:/Work/PHP/test/gd/screencap/screen.png');
    ob_end_clean();
}

function press($time)
{
    logx('��ʼ�Զ���ת');
    // ����㰴�º���΢Ų��̧��ģ����ָ
    $px = rand(500, 600);
    $py = rand(1560, 1600);
    $ux = $px + rand(-10, 10);
    $uy = $py + rand(-10, 10);
    $swipe = sprintf("%s %s %s %s", $px, $py, $ux, $uy);
    system('adb shell input swipe ' . $swipe . ' ' . $time);
}

define('PRESS_EXP', 0.842225);
define('PRESS_TIME', 3.95950169);

function main()
{
    //1.�Ƚ�ͼ
    screencap();
    //�����ͼ��Ϣ
    $image = imagecreatefrompng("screencap/screen.png");
    $player_rgb = 3554406;
//    echo '���ӵײ���ɫ: ' . $player_rgb . PHP_EOL;


    $width = imagesx($image);
    $height = imagesy($image);
    //2.�ҵ����ӵĵײ�����
    list($user_x, $user_y) = get_player_xy($image, $width, $height, $player_rgb);
    //3.�ҵ�Ҫ�����ĵص������
    list($point_x, $point_y) = get_next_xy($image, $width, $height);
    //4.�������,���㰴ѹʱ��
    $dist = sqrt(pow($point_x - $user_x, 2) + pow($point_y - $user_y, 2));
    // 2.5D��������
    $trdeg = rad2deg(asin(abs($point_x - $user_x) / $dist));
    $dist_fix = $dist * sin(deg2rad(140 - $trdeg));
    $time = pow($dist_fix, PRESS_EXP) * PRESS_TIME;
    $time = round($time);
    press($time);
}

function loop_main($times = 50000000)
{
    for ($i = 0; $i < $times; $i++) {
        logx('��ǰ��������:' . $i);
        main();
        sleep(2);
    }
}


main();
