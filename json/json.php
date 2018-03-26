<?php
$data['wx_openid_sql'] = 'select wxId from wx_user where cusId is not null and isgroup = 106';
echo json_encode($data);


echo '<br>';


$data2['wx_group_id'] = 0;
echo json_encode($data2);