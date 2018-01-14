<?php
ini_set('max_execution_time', '0');

function similar($rgb1, $rgb2, $value = 20) {
    $r1 = ($rgb1 >> 16) & 0xFF;
    $g1 = ($rgb1 >> 8) & 0xFF;
    $b1 = $rgb1 & 0xFF;
    $r2 = ($rgb2 >> 16) & 0xFF;
    $g2 = ($rgb2 >> 8) & 0xFF;
    $b2 = $rgb2 & 0xFF;
    return abs($r1 - $r2) < $value && abs($b1 - $b2) < $value && abs($g1 - $g2) < $value;
}

$image = imagecreatefrompng("tt.png");

$player_rgb = imagecolorat($image, 314, 1149);

echo '棋子底部颜色: ' . $player_rgb . PHP_EOL;

$width  = imagesx($image);
$height = imagesy($image);

echo '获得图片尺寸: ' . $width. '--' . $height . PHP_EOL;

//查找棋子底部坐标
echo '开始查找棋子底部坐标: ' . date('Y-m-d H:i:s', time()) . PHP_EOL;
$player_x = 0;
$player_y = 0;
for ($y = $height / 3 * 2; $y > $height / 3; $y--)
{
    for ($x = 0; $x < $width; $x++)
    {
        $rgb = imagecolorat($image, $x, $y);
        if (similar($rgb, $player_rgb))
        {
//            $temp_x = $x;
//            while($temp_x + 1 < $width && similar(imagecolorat($image, $temp_x+1, $y), $player_rgb))
//            {
//                $temp_x++;
//            }
//            if ($temp_x - $x > 75 * 0.5)
//            {
//
//            }
            $player_x = $x;
            $player_y = $y;
            break 2;
        }
    }
}
echo '找到坐标符合颜色: ' . $player_x . '--' . $player_y . '   ' . date('Y-m-d H:i:s', time()) .  PHP_EOL;

//模块出现区域 Y轴区域  330 - 950  X轴 0 - 1080

$aims_x = 0;
$aims_y = 0;
//echo $height / 3 . PHP_EOL;
//echo $height / 2 . PHP_EOL;

for ($b = $height / 3; $b < $height / 3 * 2; $b++)
{
    $demo = imagecolorat($image, 1, $b); //用来对比的像素
    for ($a = 0; $a < $width; $a++)
    {
        $point = imagecolorat($image, $a, $b);
        if (!similar($point, $demo, 10))
        {
            $aims_x = $a;
            $aims_y = $b;
            break 2;
        }
    }
}

echo '找到目标坐标: ' . $aims_x . '--' . $aims_y . '   ' . date('Y-m-d H:i:s', time()) .  PHP_EOL;

