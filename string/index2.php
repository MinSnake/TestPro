<?php
//中英文混合昵称，最大支持24个字节
$name = '我adsa是打算bas大声道中csd打算c文dsad啊efght你是mn中文';

define('MAX_LEN', 24);
define('ENCODING', 'UTF-8');

function cut_name($name, $temp_name, $i = 1)
{
    echo '---------------------------------------------' . PHP_EOL;
    $mb_name_len = strlen($temp_name);
    if ($mb_name_len > MAX_LEN) {
        echo '当前字符串: ' . $temp_name . PHP_EOL;
        echo '发现字节长度大于24，当前长度：' . $mb_name_len . PHP_EOL;
        $cut_len = mb_strlen($name, ENCODING) - $i;
        echo '即将截取长度：' . $cut_len . PHP_EOL;
        $temp_name = mb_substr($temp_name, 0, $cut_len, ENCODING);
        echo $temp_name . PHP_EOL;
        $i++;
        return cut_name($name, $temp_name, $i);
    } else {
        return $temp_name;
    }
}

$cut_name = cut_name($name, $name);
echo '=============================================' . PHP_EOL;
echo '最终截取结果: ' . $cut_name . PHP_EOL;
echo '最终字节长度：' . strlen($cut_name) . PHP_EOL;

echo $cut_name . PHP_EOL;
echo '字节长度: ' . strlen($cut_name) . PHP_EOL;



//$name = 'asdasd';

//echo mb_strlen($name) . PHP_EOL;
//echo strlen($name) . PHP_EOL;
//
////$url = 'http://test.unify.login.ids111.com:1080/';
//
////account/basic_info
//
//
//function check($nickname)
//{
//    if (!preg_match('/^[a-zA-Z0-9_\x{4e00}-\x{9fa5}]+$/u', $nickname)) {
//        echo $nickname .  '  ============= 不匹配  ====';
//        $nickname = preg_replace('/[^a-zA-Z0-9_\x{4e00}-\x{9fa5}]/u', "", $nickname);
//        echo '替换之后：' . $nickname;
//    }
//    else
//    {
//        echo  $nickname .  '  ===================  ok';
//    }
//    echo '<br>';
//}
//
////$msg = preg_replace("/<[^>]+>/", "", $msg);
//
//
//
//check('');
//check('123');
//check('12ds3');
//check('12d-s3');
//check('123__');
//check('__123__');
//check('__123');
//check('123!@#');
//check('!@#%%^');
//check('--123');
//check('--123--');
//check('123--');
//check('汉字中文');
//check('--汉字中文');
//check('--汉字中文1123');
//check('汉字中文1123');
//check('汉字fsdf中文1123');
//check('汉字fsdf中文1123#$%');
//check('汉字fsdf中__文112#$%3');
//check('#$%#$汉字fsdf中文112#$%3');
//check('#$%#$汉字fsdf中文1');
//check('==中文1');
//check('中=文1');
//check('中文1=');
//


//$s = 'a:26:{s:2:"id";i:1237231192;s:6:"userID";i:1237231192;s:8:"nickname";s:9:"炸鲜奶";s:6:"gender";i:0;s:6:"avatar";s:92:"https://gimg.gamdream.com/wpkfile/11798/image/20171207//9ef97cb6becd153fd9e78f51e8e8518e.png";s:9:"signature";s:0:"";s:8:"province";s:0:"";s:4:"city";s:0:"";s:11:"isCompleted";s:1:"1";s:5:"level";i:0;s:4:"role";i:1;s:3:"age";i:0;s:13:"constellatory";s:0:"";s:8:"birthday";s:10:"0000-00-00";s:5:"phone";s:11:"18682168085";s:10:"cell_phone";s:11:"18682168085";s:7:"diamond";i:0;s:5:"charm";i:42612;s:5:"money";i:0;s:8:"integral";i:0;s:12:"integralRank";a:5:{s:2:"id";s:1:"1";s:5:"level";s:1:"0";s:4:"logo";s:0:"";s:5:"start";s:1:"0";s:3:"end";s:2:"29";}s:14:"entryInhibited";s:1:"0";s:8:"agentUid";s:1:"0";s:11:"ordersState";s:1:"1";s:7:"testers";s:1:"0";s:3:"exp";s:1:"0";}';
//
//$xx = unserialize($s);
//
//
//var_dump($xx);

//$num = rand(1, 99999);
//
//$num = 2123;
//
//$temp_length = 5;
//
//$num_length = strlen($num);
//if ($num_length < $temp_length)
//{
//    //补齐前面的0
//    $zero_length = $temp_length - $num_length;
//    $zero_temp = '';
//    for ($i = 1; $i <= $zero_length; $i++)
//    {
//        $zero_temp = $zero_temp . '0';
//    }
//    $num = $zero_temp . $num;
//}
//
//echo $num;


