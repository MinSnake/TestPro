<?php

/**
 * @todo RSA
 *
 * User: jinda.li
 * Date: 2017/7/10
 * Time: 14:15
 */
class Rsa
{

    private $privateKey = '-----BEGIN RSA PRIVATE KEY-----
MIIEpAIBAAKCAQEAt6Qa2DH5ohUnYGgL2VYiTShSIuDcg43WRINW/SfdGpYjOs1o
vmD5huiTccQgNkGtKknIiRBUihXDV9jP9nJ5ScnW3Yx9WvyQK+Lhe9JLn3Hog2F+
OTIDisD+MG/Kkb48VD23EMqK6nvUXNbbmkLs5GT+wijdMPCJyvDVvV+Ke3pgGlpt
1aDQiPfBwHx21CiqKcR+TSUzSDJu0a7okrHuyLv2eMYWCk2Zq0HmnD4Z6UkKPDxd
oHZrKxvPXhr/tDYo7bEI5EOfxZjaU3tvwQclVT8Af3u/rAs8PLvy/QggNHvl4aG7
uiOhVsXI5IC+pPtABlHsA0OwCqQUlAQybKO1uQIDAQABAoIBAGx9IXLJi12Ku7mD
nkRmU1tbz7JVP1DksUnGgdSLAV9chTGO+itGZQOjUL/sCs+i2ydZcYQvxpHRK5cx
OiKxHCBQgoReJAxlmtKidW1OHmjyxVcgeI5XkqodO83nrTeOuFtYHldoIMtIHnw+
Xnvyv7pqQ+r2cz4fTHg88TiwQcKR15fsRclw7yZUgSL8CMmwC1fRYHIWGCdkWr/q
VUYqof9a9yxPfObSiA1+mEl0AE4NS8MKRkq4y6T7v6DRGWQPGEIJFy5jlJ9iYjFT
mA8YwlU8c9eZnsYdi6pudsbUtpw4B5LFR4nmpkCahHv/fTe2vIhq+G8B7tQemg/+
7ncG9YECgYEA5rxaUKO/WniSjRoRQUNDHy2dPj2gKsyUjzYkBkOIXEOxyCRPSL9F
lDwyQQMHep07/bCa26qfkppigprwdfCdlU+fVwrx0Fc/L+rRqKc+3FHD/L/nKEZI
Zn0sVOmItzEzXh/Ky7w9w44HgiR9sqEcRfFwxEGxXd6DXIMShS/vN0kCgYEAy7+p
axf7p4OZlV//vOrLrs9l4n8gx3aKt6LBeNzwdMI/gQFuiRFMYmZIWM/jA5odqOfe
g+C57cxV9LSdYcyw5n/BzKvDjs+4QRmhYLpWkVmNKg70lvngUCUK2iNsR04Ma9Xv
R/bf6Gh5Dcv5LHWSmw7s4ScIE58pdzDrjQX5WvECgYEAln7gAZzsYJwoKnSIMKMo
kptz5nbXk1LgyxArKxK9TECzIrHcLLzlKyygMptBM45+5JdeSkzdzAd6nWll0edh
QVQvv9xZoORnSF/G5FRBwf5q8N5SbYh6DK80TSYNkD89G/VslrpvJq/q4c3fVrWS
9WPng3q9r1ZFJAAyAkEjrFECgYA2OcI7MFzXjly3tp73hn3C/oudJjxxGYl9qiFX
q2WLjY8dJGZosGPl5Fbo3BsNAF1YcK11579UHIfb4p3oQ3PpRKMtd6FKRtpA6TNb
7PvRH0ZEpUpPTB149wLWX4sXxxvjL0LJolihH/znwRuFy5zDC8vbeGnb3wZIJIrs
M2TT4QKBgQCvgjTS5ypGxvUj0SdTZc0sMdbcTDVBYbytxhyh9sXoyJtuPXOtYcoB
eklNeARy4ahpXtLmViM09rNIsLmCGLeCxFOC264MEOa/SJebufao+VkbLkrqoY5j
VE4jA1xXL8i7+SJJ0JJ3WIpJYfsU3PfWwnNqsmSXnl0KkrNkLo5OWg==
-----END RSA PRIVATE KEY-----
';

    private $publicKey = '-----BEGIN PUBLIC KEY-----
MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAt6Qa2DH5ohUnYGgL2VYi
TShSIuDcg43WRINW/SfdGpYjOs1ovmD5huiTccQgNkGtKknIiRBUihXDV9jP9nJ5
ScnW3Yx9WvyQK+Lhe9JLn3Hog2F+OTIDisD+MG/Kkb48VD23EMqK6nvUXNbbmkLs
5GT+wijdMPCJyvDVvV+Ke3pgGlpt1aDQiPfBwHx21CiqKcR+TSUzSDJu0a7okrHu
yLv2eMYWCk2Zq0HmnD4Z6UkKPDxdoHZrKxvPXhr/tDYo7bEI5EOfxZjaU3tvwQcl
VT8Af3u/rAs8PLvy/QggNHvl4aG7uiOhVsXI5IC+pPtABlHsA0OwCqQUlAQybKO1
uQIDAQAB
-----END PUBLIC KEY-----
';

    public function __construct()
    {
//        $resource = openssl_pkey_new();
//        openssl_pkey_export($resource, $this->privateKey);
//        $detail = openssl_pkey_get_details($resource);
//        $this->publicKey = $detail['key'];

        var_dump($this->privateKey);
        var_dump($this->publicKey);
    }

    public function getPrivateKey()
    {
        return $this->privateKey;
    }

    public function getPublicKey()
    {
        return $this->publicKey;
    }

    public function publicEncrypt($data, $publicKey)
    {
        openssl_public_encrypt($data, $encrtpted, $publicKey);
        return $encrtpted;
    }

    public function publicDecrypt($data, $publicKey)
    {
        openssl_public_decrypt($data, $decrypted, $publicKey);
        return $decrypted;
    }

    public function privateEncrypt($data, $privateKey)
    {
        openssl_private_encrypt($data, $encrypted, $privateKey);
        return $encrypted;
    }

    public function privateDecrypt($data, $privateKey)
    {
        openssl_private_decrypt($data, $decrypted, $privateKey);
        return $decrypted;
    }
}

$rsa = new Rsa();

$publicKey = $rsa->getPublicKey();
$privateKey = $rsa->getPrivateKey();

$msg = '我是一个RSA的加密字符串，用来测试的';


echo '原始值：' . '<br>';
echo $msg . '<br>';
echo '<br>';
echo '<br>';


$public_data = $rsa->publicEncrypt($msg, $publicKey);
$public_data = base64_encode($public_data);

//$private_data = $rsa->privateEncrypt($msg, $privateKey);
//$private_data = base64_encode($private_data);


echo '公钥加密之后的值：' . '<br>';

echo $public_data . '<br><br><br><br>';

echo '私钥解密之后的值：' . '<br>';


$decode_msg = base64_decode($public_data);
$decode_msg = $rsa->privateDecrypt($decode_msg, $privateKey);

echo $decode_msg;





