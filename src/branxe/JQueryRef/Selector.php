<?php

namespace Branxe\JQueryRef;

class Selector
{
    public static function id(string $selector): string
    {
        return "#$selector";
    }

    public static function name(string $selector): string
    {
        return ".$selector";
    }
    
    public static function tagName(string $selector): string
    {
        return "$selector";
    }

    public static function custom(string $selector): string
    {
        return $selector;
    }
}
