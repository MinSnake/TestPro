<?php

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