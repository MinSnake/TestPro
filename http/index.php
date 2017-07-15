<?php

if (isset($_FILES['file']))
{


    echo var_export($_FILES, true);

    echo PHP_EOL;

    move_uploaded_file($_FILES["file"]["tmp_name"], "upload/" . $_FILES["file"]["name"]);
}
else
{
    echo 'upload fail';
}




