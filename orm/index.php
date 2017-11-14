<?php

include "init.php";

require 'User.php';
$user = User::find(1);

var_dump($user);