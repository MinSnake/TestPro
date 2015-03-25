<?php
$strtime="2014-12-21";//要求的时间
$time=strtotime($strtime);
echo $strtime." 是星期：".date('w',$time)."<br>";


echo '<br>';


echo time();