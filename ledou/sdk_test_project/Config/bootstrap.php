<?php
//测试程序类型，CM-休闲，OL-网游
define('TEST_APP_TYPE', 'CM');

//需要测试的应用列表,按照顺序执行
define('TEST_APP_LIST', array(
    'secure' => 'oauth/request_token',
));