<?php
/**
 * @Title: getOrder_no 
 * @todo 获取订单号-32位
 * 商户系统内部的订单号,32个字符内、可包含字母
 * 根据时间进行获取
 * @author Saki <ilulu4ever816@gmail.com>
 */
function getOrder_no_32(){
    $mch_id = '10035986';//8
    $date = date('YmdHis',time());//20151111111111  14
    $time = time();//10  
    $order_no = $mch_id . $date . $time;
    return md5($order_no);
}

/**
 * @Title: getOrder_no_28 
 * @todo 获取订单号-28位
 * 商户订单号（每个订单号必须唯一）
 * 组成： mch_id+yyyymmdd+10位一天内不能重复的数字。
 * @author Saki <ilulu4ever816@gmail.com>
 */
function getOrder_no_28(){
    $mch_id = '10035986';//8
    $date = date('Ymd',time());
}

/**
 * @Title: getMillisecond
 * @todo 获取毫秒级的时间戳
 * @author Saki <ilulu4ever816@gmail.com>
 */
function getMillisecond() {
    list($t1, $t2) = explode(' ', microtime());
    return (float)sprintf('%.0f', (floatval($t1) + floatval($t2)) * 1000);
}

/**
 * @Title: write_log 
 * @todo 将订单号写入log文件中
 * @param $order_no  订单号 
 * @author Saki <ilulu4ever816@gmail.com>
 */
// function write_log($order_no){
function write_log($content){
    $file_path = '/home/saki/文档/queue/';
    $file_name = 'queue.log';
    $file = $file_path . $file_name;
    if (!is_dir($file_path)){
        mkdir($file_path,0777);        
    }
    if (!file_exists($file)) { // 如果不存在则创建
        file_put_contents($file, '',FILE_APPEND);
        // 检测是否有权限操作
        if (!is_writeable($file))
            chmod($file, 0777); // 如果无权限，则修改为0777最大权限
    }
    // 最终将d写入文件即可
    $content = $content . "\n";
    file_put_contents($file, $content ,FILE_APPEND);
}

/**
 * @todo: 生成随机字符串
 * @author Saki <ilulu4ever816@gmail.com>
 * @date 2015-1-14 上午11:01:11
 * @version V1.0
 */
function create_noncestr( $length = 16 ) {
    $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
    $str ="";
    for ( $i = 0; $i < $length; $i++ )  {
        $str.= substr($chars, mt_rand(0, strlen($chars)-1), 1);
        //$str .= $chars[ mt_rand(0, strlen($chars) - 1) ];
    }
    return $str;
}

/**
 * @Title: create_nq_wx_orderno 
 * @todo  生成永远不重复的订单号 
 * 默认为纯数字的28位订单号   组成：mch_id+yyyymmdd+10位一天内不能重复的数字。
 * 也可以生成32位包含字母的订单号
 * 请根据需求进行调用
 * @param $mch_id   商户号,一般为8位
 * @param $length   订单号长度
 * @author Saki <ilulu4ever816@gmail.com>
 */
function create_nq_wx_orderno($mch_id,$length=28){
    $date_time = date('Ymd',time());//8位的时间日期-20150101
    $microtime_arr = explode(' ', microtime());
    $millisecond = $microtime_arr[0];//毫秒--eg:0.59348100
    if ($length == 28){
        //剩余的字符串长度
        $temp_strlen = 28-strlen($mch_id.$date_time);
        $millisecond = intval( $millisecond * 1000000);
        if ($temp_strlen%2 == 0){
            //还差偶数位的字符串，即生成4位数的毫秒
            $millisecond = substr($millisecond,0,4);
        }else{
            //还奇数位的字符串，即生成3位数的毫秒
            $millisecond = substr($millisecond,0,3);
        }
        $temp_strlen = $temp_strlen - strlen($millisecond);
        $min = pow(10,$temp_strlen); 
        $max = pow(10,$temp_strlen-1) -1 ; 
        $str = rand($min, $max);
        $result =  "$mch_id$date_time$str$millisecond";
    }else {
        $result = md5($mch_id.$date_time.$millisecond);
        $result = strtoupper($result);
    }
    $data['order_no'] = $result;
    $data['millisecond'] = $microtime_arr[0];
    $data['randnum'] = isset($str) ? $str : null;
    return $data;
}

for ($i=0;$i<1000;$i++){
//     $data =  create_nq_wx_orderno('10035986');
    $data =  create_nq_wx_orderno('10035986');
    $order_no = $data['order_no'];
    $millisecond = $data['millisecond'];
    $randnum = $data['randnum'];
    $len =  strlen($order_no);
//     if ($len != 32){
        write_log($order_no . '-' . $len.'-'.$millisecond.'-'.$randnum);
//     }
}

// $res = create_nq_wx_orderno('10035986',32);
// var_dump($res);