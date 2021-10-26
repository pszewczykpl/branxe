<?php

class A
{
    public static $i = 0;

    public static function add_number()
    {
        self::$i++;
    }

    public function test()
    {
        return new static();
    }
}

A::add_number();

$a = new A();
$a = $a->test();
$a::add_number();
echo A::$i;
echo $a::$i;