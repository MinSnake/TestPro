<?php
/**
 * @Title: getOrder_no 
 * @todo 获取订单号
 * 商户系统内部的订单号,32个字符内、可包含字母
 * 根据时间进行获取
 * @author Saki <ilulu4ever816@gmail.com>
 */
function getOrder_no(){
    $mch_id = '10035986';//8
    $date = date('YmdHis',time());//20151111111111  14
    $time = time();//10  
    $order_no = $mch_id . $date . $time;
    return md5($order_no);
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

$order_no = getOrder_no();
write_log($order_no);
// echo $order_no;









