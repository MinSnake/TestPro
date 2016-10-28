<?php
//输出从2016-08 到 2017-02 半年内每个月的最后一天数据情况
$month_arr = array('8', '9', '10', '11', '12', '1', '2');

foreach ($month_arr as $k => $month)
{
	//2016年
	if ((int)$month >= 8)
	{
		$year = '2016';
	}
	//2017年
	else
	{
		$year = '2017';
	}

	echo "<h4>".$year."年".$month."月</h4>";
	
	$test_tm = strtotime($year . '-' . $month);
	$date = date('Y-m-d H:i:s', $test_tm);
	$start_tm = date('Y-m-01 00:00:00', strtotime($date));
	$end_tm = date('Y-m-d 23:59:59', strtotime("$start_tm +1 month -1 day"));
	
	$end_2_tm = date('Y-m-d 00:00:00', strtotime("$start_tm +1 month -1 day"));
	
	echo $year . '-' . $month . '的时间区间：' . $end_2_tm . '-' . $end_tm;
	echo '<br>';
	
	$s_tm = strtotime($end_2_tm);
	$e_tm = strtotime($end_tm);
	
	echo $year . '-' . $month . '的时间戳区间：' . $s_tm . '-' . $e_tm;
	echo '<br>';

	
	echo '<h4>查询用户每个房源多余的上传房源加积分的次数和多加的积分：</h4>';
	
	echo "select id,uid,point,data_id,count-1,(count - 1) * point from 
(
SELECT id,uid,point,data_id,count(data_id) as count FROM `ucenter_member_point_log` 
WHERE ( `reason` = 16 ) AND ( `status` = 1 ) AND ( (`create_time` BETWEEN $s_tm AND $e_tm ) )
group by data_id order by uid desc
) x where count > 1;";



    echo '<h4>用户的uid和应该扣除的积分值：</h4>';
	
	echo "select uid,sum(allpoint) from 
(
select id,uid,point,data_id,count-1,(count - 1) * point as allpoint from 
(
SELECT id,uid,point,data_id,count(data_id) as count FROM `ucenter_member_point_log` 
WHERE ( `reason` = 16 ) AND ( `status` = 1 ) AND ( (`create_time` BETWEEN $s_tm AND $e_tm ) )
group by data_id order by uid desc
) x where count > 1
) y group by uid;";
	
	echo '<br><br>';

	
	echo '==================================================================';
		
	echo '<br><br>';
	
}
