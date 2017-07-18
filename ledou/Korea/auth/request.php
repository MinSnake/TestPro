<?php
// //token
// $oauth_token="ba0dbb9276134f1f6eba58f32e6e67f6057fc3fb9";
// $oauth_token_secret="62b8b7be0b6fed4452d350fa133fdca4";

// //game
// $oauth_consumer_key="eff44e7383eb8887e4fb";
// $oauth_consumer_secret="df9f006657f8cb7b9d52";

// //请求的api
// $http_url="http://test.feed.online.ids111.com:81/account/verify_credentials?channel_id=TEST0000000&game_version=1.0&udid=00000000-4b34-02ca-0e61-5cfe18878cbc&nudid=927_93472537541211302pqs213s1qo89&init=1&sdk_version=2.0";
// //请求的方式
// $http_method="GET";
// //$querySBS
// $params="";

// //Authorization
// $http_heard='Authorization: OAuth oauth_consumer_key="eff44e7383eb8887e4fb", oauth_token="ba0dbb9276134f1f6eba58f32e6e67f6057fc3fb9", oauth_signature_method="HMAC-SHA1", oauth_signature="vbQbmCqjHq7Tit4%2B9vE4eHsq7MQ%3D", oauth_timestamp="1476149183", oauth_nonce="2205599039192559648", oauth_version="1.0", oauth_signature_v2="BZXfTCoJ0urgEs3HEcQHakxdG%2FY%3D"';


// //token
// $oauth_token="9c77acf7b8478ad79f05ad94b206c4530584e77bc";
// $oauth_token_secret="ac5f3bfe7580eb67bf5e36584cc808c8";

// //game
// $oauth_consumer_key="680e276068bc3024dcbb";
// $oauth_consumer_secret="7b711d598c4211a07ca7";

// //请求的api
// $http_url="http://test.feed.ids111.com/to_report_log";
// //请求的方式
// $http_method="POST";
// //$querySBS
// $params="";

// //Authorization
// $http_heard='Authorization:OAuth oauth_consumer_key="680e276068bc3024dcbb", oauth_token="9c77acf7b8478ad79f05ad94b206c4530584e77bc", oauth_signature_method="HMAC-SHA1", oauth_signature="cxucv0jYszlPnXnBiBRpml%2BVWlg%3D", oauth_timestamp="1481537474", oauth_nonce="-6442911723340371440", oauth_version="1.0", oauth_signature_v2="KtlsDTOMfnDHlR28W8KiLo1wDQE%3D"';



//oauth_token=78548ea8e760f2dd4a0c4f546467b5e6058b55b8e&oauth_token_secret=005dddcf278b155f2d42a40957303404

//token
$oauth_token="78548ea8e760f2dd4a0c4f546467b5e6058b55b8e";
$oauth_token_secret="005dddcf278b155f2d42a40957303404";

//game
$oauth_consumer_key="eff44e7383eb8887e4fb";
$oauth_consumer_secret="df9f006657f8cb7b9d52";

//请求的api
$http_url="https://olpay.iplaygames.cn/payments/create";
//请求的方式
$http_method="POST";
//$querySBS
$params='{"product_id":"21488280009478","discount":"1.0","recharge":"1.0","server_id":"11","paymethod":"31","paymentstate":"1","extral_info":"extra_info","p_version":1,"auth_game_type":"1","quantity":1,"price":"1.0","nudid":"927_93472537541211302pqs213s1qo89","product_name":"coin","channel_id":"TEST0000000","udid":"00000000-4b34-02ca-0e61-5cfe7cc2f924","cli_ver":"pay-3.1.1.10","type":"8"}';//Authorization
$http_heard='Authorization:OAuth oauth_consumer_key="eff44e7383eb8887e4fb", oauth_token="78548ea8e760f2dd4a0c4f546467b5e6058b55b8e", oauth_signature_method="HMAC-SHA1", oauth_signature="NzkKupvI%2BpmxuaPgnCzzXVsQMuc%3D", oauth_timestamp="1488280009", oauth_nonce="4710119627394861064", oauth_version="1.0", oauth_signature_v2="5eqDgRWGJs2HINKm%2B7VX2K6tGmI%3D"';




// //请求的api
// $http_url="http://payv2.dev.ids111.com/payments/create";
// //请求的方式
// $http_method="POST";
// //$querySBS
// $params='{"auth_game_type":"1","quantity":1,"product_id":"31481711187003","price":"1.0","nudid":"4731405563923_741p80842489p2pr627","recharge":"1.0","server_id":"11","channel_id":"TEST0000000","udid":"ffffffff-81f2-df6c-a688-15854f105fc6","paymethod":"1004","cli_ver":"2.1.13","type":"8","extral_info":"tt"}';
// //Authorization
// $http_heard='Authorization: OAuth oauth_consumer_key="8fee977f5ba1244dc4f1", oauth_token="070b8885ea2aae911ce25b144199e4cc058511d7f", oauth_signature_method="HMAC-SHA1", oauth_signature="ag4F%2B9%2B46xTP%2BBCQ%2BfxixCRisCQ%3D", oauth_timestamp="1481711187", oauth_nonce="-8328961489670555630", oauth_version="1.0", oauth_signature_v2="k9rzb63DGnJRCU9xNzPF23psta8%3D"';





$authorization=authorization($http_heard);
$signature=$authorization['oauth_signature'];
$signature_v2=$authorization['oauth_signature_v2'];

unset($authorization['oauth_signature']);
unset($authorization['oauth_signature_v2']);

//oauth_token=6f8221bfa27f50a66272942f645fcdfa0584139a5&oauth_token_secret=e61803faf232e11940aa4e2e89170be9
$oauth=array(
    "token"=>array(
        "oauth_token"=>$oauth_token,
        "oauth_token_secret"=>$oauth_token_secret,       
    ),
    "oauth_consumer"=>array(
        "oauth_consumer_key"=>$oauth_consumer_key,
        "oauth_consumer_secret"=>$oauth_consumer_secret,  
    )
);



$oauth_signature=   build_signature($http_method,$http_url,$authorization,json_decode($params,true),$oauth,$type=1,$verifiesSign=false,$signature);

echo "签名1：";
print $oauth_signature;
echo "</br>"."\n";

echo "---------------------------------------------------------------------------------------------------------------------------------"."</br>"."\n";

$oauth_signature_v2=build_signature($http_method,$http_url,$authorization,json_decode($params,true),$oauth,$type=2,$verifiesSign=false,$signature_v2);;
echo "签2：";
print $oauth_signature_v2;
echo "</br>"."\n";




/**
 * 签名
 * @param unknown $http_method
 * @param unknown $http_url
 * @param unknown $authorization
 * @param unknown $params
 * @param unknown $oauth
 * @param number $type
 * @param string $verifiesSign
 * @param unknown $signature
 * @return boolean|string
 */ 
 function build_signature($http_method,$http_url,$authorization,$params,$oauth,$type=1,$verifiesSign=false,$signature){
     
     $rest=par_url($http_url);
     //签名一
     if ($type==1){
         $parts=base_string($http_method,$rest['url'],$authorization,$rest['query']=false);  
         $strrsign=hashsign($parts,$oauth['oauth_consumer']['oauth_consumer_secret'],$oauth['token']['oauth_token_secret']);
         //是否需要比对
         if($verifiesSign){
             return urlencode($strrsign)==$signature;
         }
          return urlencode($strrsign);
     
     //签名二
     }else{
         if($http_method=='POST'){
             $param=$params;
         }else{
             $param=$rest['query'];
         }
         
         $parts=base_string($http_method,$rest['url'],$authorization,$param);
         $strrsign=hashsign($parts,$oauth['oauth_consumer']['oauth_consumer_secret'],$oauth['token']['oauth_token_secret']);
         //是否需要比对
         if($verifiesSign){
             return urlencode($strrsign)==$signature;
         }
         return urlencode($strrsign);
     }
 }
 
 /**
  * 解析url 
  * @param unknown $url
  * @return multitype:string multitype:Ambigous
  */
 function par_url($url){
     $arr = parse_url($url);
     var_dump($arr);
     if(isset($arr['port'])){
        $api=$arr['scheme'].'://'.$arr['host'].':'.$arr['port'].$arr['path'];
     }else{
         $api=$arr['scheme'].'://'.$arr['host'].':80'.$arr['path'];
     }
     if(isset($arr['query'])){
     $arr_query = convertUrlQuery($arr['query']);         
     }else{
         $arr_query="";
     }
    return array('url'=>$api,'query'=>$arr_query);
 }
 
 
 
 /**
  * 头部数据转化
  * @param unknown $data
  */
 function authorization($data){
     
     $heard=substr($data,20,1000);
     $arr=explode(",", $heard);
     
     $arrto=array();
     foreach ($arr as $k=>$value){
         if ($k==0){
             $arr=explode("=", $value);
             $arrto['oauth_consumer_key']=str_replace('"', '', $arr[1]);
         }
         $arr=explode("=", $value);
         $arrto[trim($arr[0])]=str_replace('"', '', $arr[1]);;
     }
     return $arrto;
 }
 
 
 
 /**
  * url解析，将get请求的数据转化为数组 
  * @param unknown $query
  * @return multitype:Ambigous <>
  */
 function convertUrlQuery($query)
 {
     $queryParts = explode('&', $query);
     $params = array();
     foreach ($queryParts as $param) {
         $item = explode('=', $param);
         $params[$item[0]] = $item[1];
     }
     return $params;
 }
 
 
 /**
  * 组装签名的字符串
  * @param unknown $http_method
  * @param unknown $http_url
  * @param unknown $querySBS
  */
 function base_string($http_method,$http_url,$authorization,$params){
     
     if ($params){
        $arr=array_merge($authorization,$params);
       
     }else{
         $arr=$authorization;
     }
     ksort($arr);
     echo "请求的参数".var_dump($arr)."";
     
     $querySBS=http_build_query($arr);
     $parts = array(
         $http_method,
         $http_url,
         $querySBS
     );
     $keyparts = OAuthUtil::urlencode_rfc3986($parts);
     $base_string = implode('&', $keyparts);
     
    print "加密源串：</br>".$base_string."</br></br></br>";

     return $base_string;
 }
 
 
 
 


 /**
  * hash加密
  * @param unknown $base_string
  * @param unknown $oauth_consumer_secret
  * @param unknown $oauth_secret_key
  */
 function hashsign($base_string,$oauth_consumer_secret,$oauth_secret_key){
     
     $key_parts = array(
         $oauth_consumer_secret,
         $oauth_secret_key
     );
     $key_parts = OAuthUtil::urlencode_rfc3986($key_parts);
     
     $key = implode('&', $key_parts);
     $string=base64_encode(hash_hmac('sha1', $base_string, $key, true));
      return $string;
 }
 
 
 /**
  * 编码
  * @author martin.sun
  */
 class OAuthUtil {
     public static function urlencode_rfc3986($input) {
         if (is_array($input)) {
             return array_map(array('OAuthUtil', 'urlencode_rfc3986'), $input);
         } else if (is_scalar($input)) {
             return str_replace(
                 '+',
                 ' ',
                 str_replace('%7E', '~', rawurlencode($input))
             );
         } else {
             return '';
         }
     }
 }




