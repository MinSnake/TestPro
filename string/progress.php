<?php

//$total = 100;
//for ($i = 0; $i <= $total; $i++) {
//    //这里的50是在显示的进度条中有50个#号
//    printf("progress: [%-50s] %d%% Done\r", str_repeat('#',$i/$total*50), $i/$total*100);
//    usleep(1000 * 100);//微秒级别，1秒 = 1000毫秒  = 1000 * 1000 微秒
//}
//echo "\n";
//echo "Done!\n";


$total_progress_length = 50;
$total = 100;

for ($i = 0; $i <= $total; $i++) {
    printf("%s: [%-".$total_progress_length."s] %d%% \r", '正在处理中', str_repeat('■', $i/$total*50),  $i/$total*100);
    usleep(1000 * 100);
}
echo "\n";
echo "处理完成!\n";
