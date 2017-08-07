<?php
/**
 * Created by PhpStorm.
 * User: jinda.li
 * Date: 2017/7/28
 * Time: 10:44
 */

//$url = 'https://graph.3113.com/me?1312=31231&dfg=234';
//
//$url = substr($url, 0, strrpos($url,'?'));
//
//echo $url;
//
//
//
//$json = '{
//         "name": "Chenxi Zhu",
//          "id": "451361815243475"
//      }';
//
//$arr = json_decode($json, true);
//
//var_dump($arr);

$server_deploy_type = get_cfg_var( 'SERVER_DEPLOY_TYPE' );

var_dump($server_deploy_type);