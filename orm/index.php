<?php
//include "init.php";

include  __DIR__ . '/vendor/autoload.php';

$database = [
    'driver'    => 'mysql',
    'host'      => 'localhost',
    'database'  => 'doradora_mahjong',
    'username'  => 'root',
    'password'  => 'root',
    'charset'   => 'utf8',
    'collation' => 'utf8_unicode_ci',
    'prefix'    => '',
];

$db = new \Illuminate\Database\Capsule\Manager();

$db->addConnection($database);

$db->setAsGlobal();


$db->bootEloquent();

require 'User.php';

//$user = User::find(1);
//var_dump($user);

$s = $_GET['s'];

$langPath = '';
$langType = '';
//$langPath = 'lang';
//$langType = 'zh';

$fileload = new \Illuminate\Translation\FileLoader(new \Illuminate\Filesystem\Filesystem(), $langPath);
$translator = new \Illuminate\Translation\Translator($fileload, $langType);


$data = array(
    's' => $s,
);

//$rules = ['s' => 'required|string|min:2|max:4'];
//$rules = ['s' => 'required|string|email'];
//$rules = ['s' => 'required|string|ip'];
//$rules = ['s' => 'unique:mj_user,nickname'];
//$rules = ['s' => 'alpha_num'];
$rules = ['s' => 'required|regex:/^[a-zA-Z0-9_\x{4e00}-\x{9fa5}]+$/u'];

//var_dump($db->getConnection());
$ccc = [
    'required' => ':attribute 参数为空.',
    'min.string' => ':attribute 最小长度为:min.',
    'max.string' => ':attribute 最大长度为:max.',
    'email' => '邮箱格式不正确',
    'ip' => 'IP地址不正确',
    'regex' => ':attribute 123'
];

$v = new \Illuminate\Validation\Validator($translator, $data, $rules, $ccc, ['s' => 'sss']);

$xx = array(
    'default' => $db->getConnection()
);
$connectResolver = new \Illuminate\Database\ConnectionResolver($xx);
$connectResolver->setDefaultConnection('default');

$PresenceVerifier = new \Illuminate\Validation\DatabasePresenceVerifier($connectResolver);

$v->setPresenceVerifier($PresenceVerifier);

if ($v->fails()) {
//    $result = array('fail', $v->messages(), $v->messages()->first());
    $result = array('fail',  $v->messages()->first());
    var_dump($result);
} else {
    echo 'ok';
}






