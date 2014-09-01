<?php
//  $time = time();
    $time = 1397025995;
    
    echo date('Y-m-d H:i:s',$time);
    echo '<br>';
    
    echo time();
    
    echo '<br>';
    $min = 30*24*60;
    $time_10 = $time + ($min * 60);
    echo date('Y-m-d H:i:s',$time_10);
    
	echo '<br>';
    echo date('Y-m-d H:i:s',1399789138);
    //echo '<br>';
    //$time_now = time();
    //echo date('Y-m-d H:i:s',$time_now);
    
    echo '<br>';
	echo rand(100000, 999999);
	
	echo '<br>';
	echo date('YmdHis',time());
	 
	echo '<br>';
    $b = 0 ? 1 : 2;
    echo $b;
    //$blank_time =  ($min * 60) - ($time_now - $time);
    //echo date('i:s',$blank_time);
    //echo '<br>';
    //echo floor($blank_time/60);
    
    echo '<br>';
    
	echo date('Y-m-d');
?>
