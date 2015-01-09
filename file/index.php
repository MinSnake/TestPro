<?php
// * * * * * * 

$filename = 'text.txt';
$fp=fopen($filename, "a+");
if ( !is_writable($filename) ){
	die("文件:" .$filename. "不可写，请检查！");
}
file_put_contents ($filename, date('Y-m-d H:i:s',time())."\n",FILE_APPEND);
fclose($fp);  //关闭指针