<?php


function pngTojpg()
{
    $image_png = imagecreatefrompng('a.png');
    imagejpeg($image_png, 'b.jpg', 100);
    imagedestroy($image_png);
}

pngTojpg();
