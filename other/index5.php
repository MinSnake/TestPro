<?php
//�н�����
$url_a = urlencode('http://iwugu.playwx.com/survey/list/aid/3.html');
$win_url = 	'https://open.weixin.qq.com/connect/oauth2/authorize?' . 
			'appid=' . 'wx2fe1667c26c7b311' . 
			'&redirect_uri=' . $url_a .
			'&response_type=code&scope=snsapi_base#wechat_redirect';
echo '�н�����';	
echo '<br>';			
echo $win_url;
echo '<br>';		
echo '<br>';				
			

//����̳�
$url_b = urlencode('http://iwugu.playwx.com/shop/list.html');
$shop_url = 	'https://open.weixin.qq.com/connect/oauth2/authorize?' . 
				'appid=' . 'wx2fe1667c26c7b311' . 
				'&redirect_uri=' . $url_b .
				'&response_type=code&scope=snsapi_base#wechat_redirect';
echo '����̳�';
echo '<br>';	
echo $shop_url;
echo '<br>';		
echo '<br>';	


//�������
$url_c = urlencode('http://iwugu.playwx.com/website/list.html');
$website_url = 	'https://open.weixin.qq.com/connect/oauth2/authorize?' . 
				'appid=' . 'wx2fe1667c26c7b311' . 
				'&redirect_uri=' . $url_c .
				'&response_type=code&scope=snsapi_base#wechat_redirect';
echo '�������';
echo '<br>';	
echo $website_url;
echo '<br>';		
echo '<br>';	


//�������
$url_d = urlencode('http://iwugu.playwx.com/user/index.html');
$point_url = 	'https://open.weixin.qq.com/connect/oauth2/authorize?' . 
				'appid=' . 'wx2fe1667c26c7b311' . 
				'&redirect_uri=' . $url_d .
				'&response_type=code&scope=snsapi_base#wechat_redirect';
echo '�������';
echo '<br>';	
echo $point_url;
echo '<br>';		
echo '<br>';	
