<?php
    $connect = mysqli_connect("10.0.0.91", "saki", "584521", "test");
    if (mysqli_connect_errno($connect))
    {
        die('无法连接到MYSQL数据库，错误：' . mysqli_connect_error());
    }
	$sql = 'INSERT INTO user_innodb (name, age, sex, content, ctm, utm) VALUES ';
    for ($i = 0; $i < 1000; $i++){
        $name = md5($i . rand(1, 99999));
        $age = rand(1, 90);
        $sex = rand(0, 1);
        $content = md5($i) . '-' . time() . '-' . md5($age.$sex.time());
        $ctm = $utm = time();
        $sql .= "('$name', $age, $sex, '$content', $ctm, $utm) ,";
	}		
    
    $sql = substr($sql, 0, strlen($sql)-1); 
    //echo $sql;
    
    mysqli_query($connect, $sql);
    mysqli_close($connect);
    
?>
