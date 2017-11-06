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

/**
 * 台湾局域网的测试地址
 */
//define('SECURE_HOST_URL'   , 'http://olsecure.overseas.ids111.com:88');
//define('FEED_HOST_URL'     , 'http://olfeed.overseas.ids111.com:88');
//define('PAYMENT_HOST_URL'  , 'http://olpay.overseas.ids111.com:88');

/**
 * 本地测试的测试地址
 */
define('SECURE_HOST_URL'  , 'http://ol.taiwan.secure.me');
define('FEED_HOST_URL'    , 'http://ol.taiwan.feed.me');
define('PAYMENT_HOST_URL' , 'http://ol.taiwan.payment.me');


//需要测试的应用列表,按照顺序执行
define('TEST_APP_LIST', array(
    array('secure' , 'oauth/request_token'),
    array('secure' , 'oauth/authenticate'),
    array('secure' , 'oauth/access_token'),
    array('feed'   , 'account/verify_credentials'),
    array('payment', 'payments/create'),
));