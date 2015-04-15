<?php   
/*  
*str_replace php 的空格回车字符替换函数  下面是多空格和回车的效果与原理
*br_nbsp.php  
*/  
echo 'str_replace php 的替换函数  下面是多空格和回车的效果与原理<hr>';   
echo '把内容 函数 $content里面的 ascII码 替换成回车和空格<hr>';   
function htmtocode($content) {   
        $content = str_replace("\n", "<br>", str_replace(" ", " ",
 $content));   
        return $content;    
}   
    
$nbsp="一个空   格 多个空                   格";     //带多空格的字符串
       echo str_replace(" ","&nbsp",$nbsp);   //空格转换函数用 ascII码去替换空格   
       echo '<hr>';   
$br="我是回  
 车    我再回  
 车";            //带回车的字符串   
        echo str_replace("\n","<br>",$br);    //用 ascII码 去替换回车
        echo '<hr>';   
    
$content="我是空                  格                          和回
车                   再回                           车  
      车             <hr>";   
        echo htmtocode($content);   
?>