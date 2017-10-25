<?php
//App::import('Vendor', 'oauth', array('file' => 'OAuth'.DS.'oauth_consumer.php'));
//App::import('Vendor', 'oauth', array('file' => 'OAuth'.DS.'OAuth.php'));

require 'oauth_consumer.php';
require 'OAuth.php';
class Sdk1Controller extends AppController
{
    public $name = 'Sdk1';
    public $uses = array();
    public $helpers = array('Javascript');
    public $autoRender = false;

    public $currentGameId = 10058;
    public $host = 'https://in1.secure.uu.cc';
    public $feed_host = 'https://in1.feed.uu.cc';
    public $payment_host = 'http://sdkpay.uu.cc';

//  public $host = 'https://af-secure.ldoverseas.com';
//  public $feed_host = 'https://af-feed.ldoverseas.com';
//  public $payment_host = 'http://af-pay.ldoverseas.com';


//     public $host = 'http://test.secure.online.ids111.com:81';
//     public $feed_host = 'http://test.feed.online.ids111.com:81';
//     public $payment_host = 'http://192.168.111.71/dgc_payment';
//     public $payment_host = 'http://payv2.dev.ids111.com';

//     public $host = 'http://test.zzz.in1.secure.ids111.com:81';
//     public $feed_host = 'http://test.zzz.in1.feed.ids111.com:81';
//     public $payment_host = 'http://payv3.dev.ids111.com';



    public $consumers = array(
        '10000' => array(
            'key' => '0685bd9184jfhq22',
            'secret' => 'ad180jjd733klru7'
        ),
//         '10058' => array(
//             'key' => '8fee977f5ba1244dc4f1',
//             'secret' => '02f1221f49bb90bc68f3'
//         ),
        '10058' => array(
            'key' => '8fee977f5ba1244dc4f1',
            'secret' => '02f1221f49bb90bc68f3'
        ),
        '10106' => array(
            'key' => 'ae4206c4db4b11e75b61',
            'secret' => 'a72218bdc3e512cd11d0'
        ),
        '10035' => array(
            'key' => '2e0e88d80129984c3d54',
            'secret' => '5883b57eaf03cb138209'
        ),
        '10088' => array(
            'key' => '29051bf5feb7d4ecc5cf',
            'secret' => 'd2323d4f0320853c9c36'
        ),
        // 上古部落
        '10081' => array(
            'key' => '69680e5c389af6a91c0e',
            'secret' => '2bd42add5659b03e3566'
        ),
        '10076' => array(
            'key' => '6a504c6e52f3cad28130',
            'secret' => 'ae95d71fa6196b5e93ce'
        ),
        '10098' => array(
            'key' => '83438c16f7ced0f46910',
            'secret' => '9fda3dbd5fc047fd1208'
        ),
        '10026' => array(//hi乐逗
            'key' => 'dca86573c0c52ba442f9',
            'secret' => '4e30d52ae3e64273a39f'
        ),
        '10027' => array(
            'key' => '7765bf151b63f2b8ed35',
            'secret' => '9fb78a01534b020d7ef3'
        ),
        '10028' => array( //联想游戏世界
        	'key' => 'dcb86573c0c52ba442f9',
        	'secret' => '4eb0d52ae3e64273a39f',
        ),
        '10206' => array( //联想游戏世界
        	'key' => '9db35efa7cb23fc81576',
        	'secret' => 'd4610539c290c36b4007',
        ),
        '10329' => array( //联想游戏世界
        	'key' => '44ca08e61776c232ccb1',
        	'secret' => 'c42bf2968040d2bf23b7',
        )
    );

    public $accessTokens = array(
        '10058_372109' => array(
            'key' => '0fd45142c2fbb83c1f52f6a627edfc5204f1cf3c6',
            'secret' => '4c3dc39081355496a2d95e9e7cd6809a'
        )
    );
    
    public $udid = array('nudid'=>'83q1q11n1_3229119054873088411r854','udid'=>'00000000-439c-a1d4-ffff-ffff8c78a45e');

    function createConsumer()
    {
        return new OAuth_Consumer(
            $this->consumers[$this->currentGameId]['key'],
            $this->consumers[$this->currentGameId]['secret']
        );
    }

    function getAccessToken($key)
    {
        return $this->accessTokens[$this->currentGameId.'_'.$this->currentPlayerId][$key];
    }

    public function index()
    {
        $thisReflection = new ReflectionClass($this);
        $methods = $thisReflection->getMethods();
        $r = $thisReflection->getMethod('index');
        $data = array();
        foreach ($methods as $method) {
            preg_match('/href {([^\}]*)}/', $method->getDocComment(), $rs);
            if ($rs) {
                list($controller) = split('/', $rs[1]);
                $methodName = $method->getName();
                $data[$controller][$methodName] = $rs[1];
            }
        }
        array_multisort($data, SORT_ASC);
        $this->set("data", $data);
        $this->render('index');
    }

    /**
     * @href {oauth/request_token}
     */
    function request_token()
    {
        $consumer = $this->createConsumer();
        $api = $this->host.'/oauth/request_token';
        $requestToken = $consumer->getRequestToken($api,'oob','POST',$this->udid);
        return $requestToken;
    }
    
    /**
     * 
     * @href {oauth/authenticate}
     */
    function authenticate($token=null,$secret=null)
    {
        $api = $this->host."/oauth/authenticate";
        $consumer = $this->createConsumer();
//         $datastr = "device_number=unknown&login_name=alan626&device_system_version=6.0.1&login_password=willxing&device_cpu_freq=2265600&device_resolution=1080X1776&nudid=83q1q11n1_3229119054873088411r854&login_type=0&device_model=Nexus+5&channel_id=TEST0000000&device_identifier=358239054664778&udid=00000000-439c-a1d4-ffff-ffff8c78a45e&device_brand=google&device_google_account=unknown";
//        $datastr = "device_number=unknown&login_name=alan626&device_system_version=6.0.1&login_password=alan19880626&device_cpu_freq=2265600&device_resolution=1080X1776&nudid=83q1q11n1_3229119054873088411r854&login_type=0&device_model=Nexus+5&channel_id=TEST0000000&device_identifier=358239054664778&udid=00000000-439c-a1d4-ffff-ffff8c78a45e&device_brand=google&device_google_account=unknown";
//监控系统使用的用户名{TEST20170816} 密码{TEST000000} 做登陆支付监控
        $datastr = "device_number=unknown&login_name=TEST20170816&device_system_version=6.0.1&login_password=TEST000000&device_cpu_freq=2265600&device_resolution=1080X1776&nudid=83q1q11n1_3229119054873088411r854&login_type=0&device_model=Nexus+5&channel_id=TEST0000000&device_identifier=358239054664778&udid=00000000-439c-a1d4-ffff-ffff8c78a45e&device_brand=google&device_google_account=unknown";
       
        $data = $this->data($datastr);
        $res = $consumer->post($token, $secret, $api,$data);
    }
    
    /**
     *
     * @href {oauth/access_token}
     */
    function access_token($token=null,$secret=null)
    {
        $api = $this->host."/oauth/access_token";
        $consumer = $this->createConsumer();
        $data = $this->udid;
        $res = $consumer->post($token, $secret, $api,$data);
    }

    /**
     * @href {account/verify_credentials}
     */
    function account_verify_credentials($token=null,$secret=null)
    {
        $api = $this->feed_host."/account/verify_credentials";
        $datastr = 'channel_id=TEST0000000&game_version=1.0.0&udid=00000000-439c-a1d4-ffff-ffff8c78a45e&nudid=83q1q11n1_3229119054873088411r854&init=1&sdk_version=2.0';
        $consumer = $this->createConsumer();
        $data = $this->data($datastr);
        $res = $consumer->get($token, $secret, $api, $data);
        return json_decode($res,true);
    }

    /**
     * @href {account/verify_credentials}
     */
    function account_getPlayerId($token=null,$secret=null,$accountinfo)
    {
        $api = $this->feed_host."/account/getPlayerId";
        $datastr = 'game_id='.$accountinfo['result']['game']['id'].'&uid='.$accountinfo['result']['player']['id'];
        $consumer = $this->createConsumer();
        $data = $this->data($datastr);
        $res = $consumer->post($token, $secret, $api, $data);
    }

    /**
     * @href {payments/create}
     */
    function payments_create($token=null,$secret=null)
    {
        $api = $this->payment_host."/payments/create";
        $consumer = $this->createConsumer();
        //$datastr = '%7B%22product_id%22%3A%2221470904642281%22%2C%22discount%22%3A%221.0%22%2C%22recharge%22%3A%220.01%22%2C%22server_id%22%3A%22serverId%22%2C%22paymethod%22%3A%2231%22%2C%22paymentstate%22%3A%221%22%2C%22extral_info%22%3Anull%2C%22p_version%22%3A1%2C%22auth_game_type%22%3A%221%22%2C%22quantity%22%3A1%2C%22price%22%3A%220.01%22%2C%22nudid%22%3A%2283q1q11n1_3229119054873088411r854%22%2C%22channel_id%22%3A%22TEST0000000%22%2C%22udid%22%3A%2200000000-439c-a1d4-ffff-ffff8c78a45e%22%2C%22cli_ver%22%3A%22pay-3.1.1.7%22%2C%22type%22%3A%228%22%7D';
        $datastr = '%7b%22product_id%22%3a%2221470904642281%22%2c%22discount%22%3a%221.0%22%2c%22recharge%22%3a%220.01%22%2c%22server_id%22%3a%22serverId%22%2c%22paymethod%22%3a%2231%22%2c%22paymentstate%22%3a%221%22%2c%22extral_info%22%3anull%2c%22p_version%22%3a1%2c%22auth_game_type%22%3a%222%22%2c%22quantity%22%3a1%2c%22price%22%3a%220.01%22%2c%22nudid%22%3a%2283q1q11n1_3229119054873088411r854%22%2c%22channel_id%22%3a%22TEST0000000%22%2c%22udid%22%3a%2200000000-439c-a1d4-ffff-ffff8c78a45e%22%2c%22cli_ver%22%3a%22pay-3.1.1.7%22%2c%22type%22%3a%228%22%7d';
        $data = json_decode(urldecode($datastr),true);
        $res = $consumer->post_payment($token, $secret, $api, $data);
var_dump($res );
    }
    /**
     * @href {account/openid_sessionid}
     */
    function openid_sessionid($token=null,$secret=null)
    {
        $api = $this->feed_host."/account/openid_sessionid";
        $consumer = $this->createConsumer();
        $datastr = '%7B%22nudid%22%3A%2283q1q11n1_3229119054873088411r854%22%2C%22player_id%22%3A%22436045202%22%2C%22udid%22%3A%2200000000-439c-a1d4-ffff-ffff8c78a45e%22%7D';
        $data = json_decode(urldecode($datastr),true);
        $res = $consumer->post($token, $secret, $api, $data);
    }
	
	//数据转换
	function data($datastr)
	{
	    $data = array();
	    $a = explode("&",$datastr);
	    foreach($a as $v) {
	        $b = explode("=", $v);
	        $data[$b[0]] = $b[1];
	    }
	    return $data;
	}
}
