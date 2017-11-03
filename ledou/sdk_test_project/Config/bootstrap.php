<?php
//测试程序类型，Cm-休闲，Ol-网游
define('TEST_APP_TYPE', 'Ol');

/**
 * 测试程序测试的所在地区
 * TW   -  台湾
 * USA  -  美洲
 * AS   -  亚洲
 * AF   -  非洲
 * ME   -  中东
 * EUR  -  欧美
 * KOR  -  韩国
 */
define('TEST_APP_AREA', 'TW');

//需要测试的应用列表,按照顺序执行
define('TEST_APP_LIST', array(
    'secure' => 'oauth/request_token',
));