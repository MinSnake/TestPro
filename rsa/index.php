<?php

/**
 * @todo RSA?????
 *
 * User: jinda.li
 * Date: 2017/7/10
 * Time: 14:15
 */
class Rsa
{

    private $privateKey = '';

    private $publicKey = '';

    public function __construct()
    {
        //����һ�Թ�˽Կ
        $resource = openssl_pkey_new();
        //����Կ����
        openssl_pkey_export($resource, $this->privateKey);
        //This function returns the key details (bits, key, type).
        $detail = openssl_pkey_get_details($resource);
        $this->publicKey = $detail['key'];
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

$msg = '����һ�������õļ�����Ϣ';

$publicKey_msg = $rsa->publicEncrypt($msg, $publicKey);
$publicKey_msg = base64_encode($publicKey_msg);


//���ܼ�������

$decode_msg = base64_decode($publicKey_msg);
$decode_msg = $rsa->privateDecrypt($decode_msg, $privateKey);
//$decode_msg = $rsa->publicDecrypt($decode_msg, $publicKey);

echo $decode_msg;





