<?php
function sql_2_table($sql){
	$sql_arr = explode(',', $sql);
	echo '| 字段名称 | 字段类型 | 属性 | 默认值  | 说明 |'. '<br>';
	echo '| --- | --- | ---- | ---- | ---- |'. '<br>';
	foreach ($sql_arr as $str){
		//替换所有不需要的字符串
		$str = str_replace("utf8_bin ", "", $str);
		$str = str_replace("CHARACTER SET latin1", "", $str);
		$str = str_replace("COLLATE ", "", $str);
		$str = str_replace("COMMENT ", "", $str);
		$str = str_replace("CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP", "当前时间", $str);
		$str = str_replace("`", "", $str);
		$str = str_replace("'", "", $str);
		//再次切割字符串
		$str = trim($str);
		$temp_arr = explode(' ', $str);
		foreach ($temp_arr as $k=>$v){
			$temp_str = $v;
			if (isset($temp_arr[$k-1])){
				//属性
				if (($temp_arr[$k] == 'NULL' && $temp_arr[$k-1] == 'NOT') || $temp_arr[$k-1] == 'DEFAULT'){
					$temp_str =' ' . $temp_str;
				}else {
					$temp_str =' | ' . $temp_str;
				}
			}else{
				$temp_str ='| ' . $temp_str;
			}
			echo $temp_str;
		}
		echo '|';
		echo'<br>';
	}
}


$sql = "  `id` int(11) NOT NULL DEFAULT 1 COMMENT '123',
  `conf_id` int(11) NOT NULL,
  `key` varchar(45) COLLATE utf8_bin DEFAULT NULL COMMENT '类型唯一值',
  `title` varchar(100) COLLATE utf8_bin DEFAULT NULL COMMENT '类型标题',
  `tenant_id` int(11) DEFAULT NULL COMMENT '商户ID',
  `ctm` datetime DEFAULT NULL COMMENT '创建时间',
  `utm` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '修改时间'";
sql_2_table($sql);
