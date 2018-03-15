<?php
require 'Rsa.php';
//$rsa = Rsa::getInstance('android/privkey.pem', 'android/pubkey.pem');
$rsa = Rsa::getInstance('ios/privkey.pem', 'ios/pubkey.pem');


$xx = $rsa->pubEncrypt('3001403508');

echo $xx . PHP_EOL;
//$a = '123';
//$b = $rsa->pubEncrypt($a);
//echo $b;
//echo '<br>';
//$c = $rsa->privDecrypt($b);
//echo $c;




//$str = 'rO6CHk/rKxzPmXamUxQ8SNbhCYuV/sFv8iYLx0D4M2sUfwdZmtOTcdr/yq5EQEO7enS0Y1IUNK1dCEuvT5nc7Gb0Mgp+pOOOGDKreM5tQKyLPCXGdoTMUtmZSCf1YoBmz9ommjQw1ovodyO3kP4ev6zhGOjc+AyFYaO8g0p6G8xaGyHqmtWwNYpExUb+g9LXGVUAK0xguMq8pnlkyIrM40ZwRTJjKg5MKtUMXKgI4o9PlPSFXmLnyDdXXMEck//WmDU2GscNAGtRaJsa175402wU1yKADoAT/Trp47oIGdiuNLtZlhWPigmxknLSnr0H8kxWyjvpNu9CGPJq28/r9A==';
//$res = $rsa->privDecrypt($str);
//echo $res;