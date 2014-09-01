<?php 
$file="35.jpg";
//$file="saki—1.jpg";
$type=getimagesize($file);//取得图片的大小，类型等
$fp=fopen($file,"r")or die("Can't open file");
$file_content=chunk_split(base64_encode(fread($fp,filesize($file))));//base64编码
switch($type[2]){//判读图片类型
	case 1:$img_type="gif";break;
	case 2:$img_type="jpg";break;
	case 3:$img_type="png";break;
}
$img='data:image/'.$img_type.';base64,'.$file_content;//合成图片的base64编码
echo $file_content;
//echo base64_decode($file_content);
fclose($fp);


file_put_contents(time() . '.jpg', base64_decode($file_content));

?>
<!-- 
<img id="img1" src="<?php echo $img;?>"/>  
-->