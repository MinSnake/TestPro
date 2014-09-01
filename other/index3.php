<?php
if(preg_match("/1[3458]{1}\d{9}$/",'12345679811')){
    echo "是手机号码";
}else{
	echo "不是手机号码";
}
