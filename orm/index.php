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

$langPath = 'lang';
$langType = 'zh';

$fileload = new \Illuminate\Translation\FileLoader(new \Illuminate\Filesystem\Filesystem(), $langPath);
$translator = new \Illuminate\Translation\Translator($fileload, $langType);


$data = array(
    's' => $s,
);

//$rules = ['s' => 'required|string|min:2|max:4'];
//$rules = ['s' => 'required|string|email'];
//$rules = ['s' => 'required|string|ip'];
$rules = ['s' => 'unique:default.mj_user,nickname'];

//var_dump($db->getConnection());

$v = new \Illuminate\Validation\Validator($translator, $data, $rules);

$xx = array(
    'default' => $db->getConnection()
);
$connectResolver = new \Illuminate\Database\ConnectionResolver($xx);
//$connectResolver->setDefaultConnection('default');

$PresenceVerifier = new \Illuminate\Validation\DatabasePresenceVerifier($connectResolver);

$v->setPresenceVerifier($PresenceVerifier);

if ($v->fails()) {
//    $result = array('fail', $v->messages(), $v->messages()->first());
    $result = array('fail',  $v->messages()->first());
    var_dump($result);
} else {
    echo 'ok';
}






