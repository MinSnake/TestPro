<?php
/**
 * RSA算法类
 * 签名及密文编码：base64字符串/十六进制字符串/二进制字符串流
 * 填充方式: PKCS1Padding（加解密）/NOPadding（解密）
 *
 * Notice:Only accepts a single block. Block size is equal to the RSA key size!
 * 如密钥长度为1024 bit，则加密时数据需小于128字节，加上PKCS1Padding本身的11字节信息，所以明文需小于117字节
 *
 * @author: linvo
 * @version: 1.0.0
 * @date: 2013/1/23
 */
class Rsa{

    private static  $pubKey = null;
    private static $priKey = null;

    //静态变量保存全局实例
    private static $_instance = null;
    //静态方法，单例统一访问入口
    static public function getInstance($private_key_file = '',$public_key_file = '') {
        if (is_null ( self::$_instance ) || isset ( self::$_instance )) {
            self::$_instance = new self ($private_key_file,$public_key_file);
        }
        return self::$_instance;
    }

    /**
     * 构造函数
     *
     * @param string 公钥文件（验签和加密时传入）
     * @param string 私钥文件（签名和解密时传入）
     */
    public function __construct($private_key_file = '',$public_key_file = ''){
        if ($public_key_file){
            $this->_getPublicKey($public_key_file);
        }
        if ($private_key_file){
            $this->_getPrivateKey($private_key_file);
        }
    }


    /**
     * 生成签名
     *
     * @param string 签名材料
     * @param string 签名编码（base64/hex/bin）
     * @return 签名值
     */
    public function sign($data, $code = 'base64'){
        $ret = false;
        if (openssl_sign($data, $ret, self::$priKey)){
            $ret = $this->_encode($ret, $code);
        }
        return $ret;
    }

    /**
     * 验证签名
     *
     * @param string 签名材料
     * @param string 签名值
     * @param string 签名编码（base64/hex/bin）
     * @return bool
     */
    public function verify($data, $sign, $code = 'base64'){
        $ret = false;
        $sign = $this->_decode($sign, $code);
        if ($sign !== false) {
            switch (openssl_verify($data, $sign, self::$pubKey)){
                case 1: $ret = true; break;
                case 0:
                case -1:
                default: $ret = false;
            }
        }
        return $ret;
    }


    /**
     * @todo 公钥加密
     *
     * @param $data
     * @param string $code
     * @param int $padding
     *
     * @author jinda.li
     * @date 2017年12月17日21:55:40
     * @return bool|string
     */
    public function pubEncrypt($data, $code = 'base64', $padding = OPENSSL_PKCS1_PADDING)
    {
        $ret = false;
        if (!$this->_checkPadding($padding, 'en')) $this->_error('padding error');
        if (openssl_public_encrypt($data, $result, self::$pubKey , $padding)){
            $ret = $this->_encode($result, $code);
        }
        return $ret;
    }


    /**
     * @todo 私钥解密
     *
     * @param $data
     * @param string $code
     * @param int $padding
     * @param bool $rev
     * @return bool|string
     *
     * @author jinda.li
     * @date 2017年12月17日21:55:40
     */
    public function privDecrypt($data, $code = 'base64', $padding = OPENSSL_PKCS1_PADDING, $rev = false){
        $ret = false;
        $data = $this->_decode($data, $code);
        if (!$this->_checkPadding($padding, 'de')) $this->_error('padding error');
        if ($data !== false){
            if (openssl_private_decrypt($data, $result, self::$priKey, $padding)){
                $ret = $rev ? rtrim(strrev($result), "\0") : ''.$result;
            }
        }
        return $ret;
    }

    /**
     * 加密
     *
     * @param string 明文
     * @param string 密文编码（base64/hex/bin）
     * @param int 填充方式（貌似php有bug，所以目前仅支持OPENSSL_PKCS1_PADDING）
     * @return string 密文
     */
    public function encrypt($data, $code = 'base64', $padding = OPENSSL_PKCS1_PADDING){
        $ret = false;
        if (!$this->_checkPadding($padding, 'en')) $this->_error('padding error');
        if (openssl_public_encrypt($data, $result, self::$priKey , $padding)){
            $ret = $this->_encode($result, $code);
        }
        return $ret;
    }

    /**
     * 解密
     *
     * @param string 密文
     * @param string 密文编码（base64/hex/bin）
     * @param int 填充方式（OPENSSL_PKCS1_PADDING / OPENSSL_NO_PADDING）
     * @param bool 是否翻转明文（When passing Microsoft CryptoAPI-generated RSA cyphertext, revert the bytes in the block）
     * @return string 明文
     */
    public function decrypt($data, $code = 'base64', $padding = OPENSSL_PKCS1_PADDING, $rev = false){
        $ret = false;
        $data = $this->_decode($data, $code);
        if (!$this->_checkPadding($padding, 'de')) $this->_error('padding error');
        if ($data !== false){
            if (openssl_private_decrypt($data, $result, self::$pubKey, $padding)){
                $ret = $rev ? rtrim(strrev($result), "\0") : ''.$result;
            }
        }
        return $ret;
    }


    // 私有方法

    /**
     * 检测填充类型
     * 加密只支持PKCS1_PADDING
     * 解密支持PKCS1_PADDING和NO_PADDING
     *
     * @param int 填充模式
     * @param string 加密en/解密de
     * @return bool
     */
    private function _checkPadding($padding, $type){
        if ($type == 'en'){
            switch ($padding){
                case OPENSSL_PKCS1_PADDING:
                    $ret = true;
                    break;
                default:
                    $ret = false;
            }
        } else {
            switch ($padding){
                case OPENSSL_PKCS1_PADDING:
                case OPENSSL_NO_PADDING:
                    $ret = true;
                    break;
                default:
                    $ret = false;
            }
        }
        return $ret;
    }

    private function _encode($data, $code){
        switch (strtolower($code)){
            case 'base64':
                $data = base64_encode(''.$data);
                break;
            case 'hex':
                $data = bin2hex($data);
                break;
            case 'bin':
            default:
        }
        return $data;
    }

    private function _decode($data, $code){
        switch (strtolower($code)){
            case 'base64':
                $data = base64_decode($data);
                break;
            case 'hex':
                $data = $this->_hex2bin($data);
                break;
            case 'bin':
            default:
        }
        return $data;
    }

    private function _getPublicKey($file){
        $key_content = $this->_readFile($file);
        if ($key_content){
            self::$pubKey = openssl_get_publickey($key_content);
        }
    }

    private function _getPrivateKey($file){
        $key_content = $this->_readFile($file);
        if ($key_content){
            self::$priKey = openssl_get_privatekey($key_content);
        }
    }

    private function _readFile($file){
        $ret = false;
        if (!file_exists($file)){
            $this->_error("The file {$file} is not exists");
        } else {
            $ret = file_get_contents($file);
        }
        return $ret;
    }


    private function _hex2bin($hex = false){
        $ret = $hex !== false && preg_match('/^[0-9a-fA-F]+$/i', $hex) ? pack("H*", $hex) : false;
        return $ret;
    }

    /**
     * 自定义错误处理
     */
    private function _error($msg){
        die('RSA Error:' . $msg); //TODO
    }

}