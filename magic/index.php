<?php

class A
{
    public function test()
    {
        static::who();
//        A::who();
//        self::who();
//        $this->who();
    }

    /**
     *私有方法
     */
    private function test2()
    {

    }

    public static function __callStatic($a, $b)
    {
        var_dump('A static');
    }

    public function __call($a, $b)
    {
        var_dump('A call');
    }
}

$a = new A;
$a->test();
//A::test1();
//$a->test2();