<?php
$xml = '<a>123</a>';
$handle = fopen('E:/test.log',"a+");/*根据需要更改这里的参数*/
$contents = fwrite($handle,$xml);
fclose($handle);




