<?php

class MorseCode
{

    private $char_morse_code;//24字母

    private $num_morse_code;//0-1数字

    public function __construct()
    {
        // [.] -> 0
        // [-] -> 1
        $this->char_morse_code = array(
            'A' => '01',
            'B' => '1000',
            'C' => '1010',
            'D' => '100',
            'E' => '0',
            'F' => '0010',
            'G' => '110',
            'H' => '0000',
            'I' => '00',
            'J' => '0111',
            'K' => '101',
            'L' => '0100',
            'M' => '11',
            'N' => '10',
            'O' => '111',
            'P' => '0110',
            'Q' => '1101',
            'R' => '010',
            'S' => '000',
            'T' => '1',
            'U' => '001',
            'V' => '0001',
            'W' => '011',
            'X' => '1001',
            'Y' => '1011',
            'Z' => '1100',
        );

        $this->num_morse_code = array(
            '0' => '11111',
            '1' => '01111',
            '2' => '00111',
            '3' => '00011',
            '4' => '00001',
            '5' => '00000',
            '6' => '10000',
            '7' => '11000',
            '8' => '11100',
            '9' => '11110',
        );

    }


    /**
     * @todo 解密
     * @param $morse            解密的摩斯码
     * @param string $point [.] (点 代表的字符串)
     * @param string $line [-] (线 代表的字符串)
     * @param string|$delimiter 分隔符 (-.-/-./---/.---) 其中的 / 就是分隔符
     * @return string
     */
    public function morse_decode($morse, $point = '.', $line = '-', $delimiter = '/')
    {
        $result = '';
        $char_morse_code = $this->char_morse_code;
        $num_morse_code = $this->num_morse_code;
        if (substr($morse, -1) === '/') {
            $morse = substr($morse, 0, strlen($morse) - 1);
        }
        $morse = str_replace($point, "0", $morse);
        $morse = str_replace($line, "1", $morse);
        //将摩斯码按照分隔符变成数组
        $morse_arr = explode($delimiter, $morse);
        foreach ($morse_arr as $key => $char) {
            $char_find = array_search($char, $char_morse_code, true);
            if ($char_find != false) {
                $result .= $char_find;
            }
            $num_find = array_search($char, $num_morse_code, true);
            if ($num_find != false) {
                $result .= $num_find;
            }
        }
        return $result;
    }

    /**
     * @todo 加密
     * @param $str
     * @param string $point
     * @param string $line
     * @param string $delimiter
     * @return mixed|string
     */
    public function morse_encode($str, $point = '.', $line = '-', $delimiter = '/')
    {
        $char_morse_code = $this->char_morse_code;
        $num_morse_code = $this->num_morse_code;
        $result = '';
        //1.首先全部转成大写
        $str = mb_strtoupper($str);
        for ($i = 0; $i < mb_strlen($str, 'utf8'); $i++) {
            $char = mb_substr($str, $i, 1, 'utf-8');
            if ($char === ' ') {
                $result .= '';
            } elseif (isset($char_morse_code[$char])) {
                $result .= $char_morse_code[$char] . $delimiter;
            } elseif (isset($num_morse_code[$char])) {
                $result .= $num_morse_code[$char] . $delimiter;
            }
        }
        $result = str_replace("0", $point, $result);
        $result = str_replace("1", $line, $result);
        return $result;
    }

}

$morseUtil = new MorseCode();

//$str = 'i love u';
//$result = $morseUtil->morse_encode($str,$point = '.', $line = '_', $delimiter = '/');
//echo $result . PHP_EOL;

$morse_str = '..-./----./-..../...--/..-/..-./----./.----/-..-/-..-/..-./...../----./-.--/----./..-./-..../..---/.----/.----/..-./-..../--.../-..../...../..-./....-/...-/---../-..../';
$result = $morseUtil->morse_decode($morse_str, $point = '.', $line = '-', $delimiter = '/');
echo $result . PHP_EOL;
