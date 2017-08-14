<?php



function generateKey( $unique = false ) {
    $key = md5(uniqid(rand(), true));
    if ( $unique ) {
        list($usec,$sec) = explode(' ',microtime());
        //把十进制转换为十六进制。
        $key .= dechex($usec).dechex($sec);
    }
    return $key;
}

echo microtime(); //0.03774400 1502697789

echo '<br>';

list($usec,$sec) = explode(' ',microtime());

echo $usec;
echo '<br>';
echo $sec;



echo '<br>';



echo dechex($usec);
echo '<br>';
echo dechex($sec);

$aa = generateKey();

echo '<br>';
echo $aa;