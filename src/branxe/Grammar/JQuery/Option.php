<?php

namespace Branxe\Grammar\JQuery;

class Option
{
    public static function new($text, $value, $defaultSelected = False, $selected = False): string
    {
        return "new Option(\"$text\", \"$value\")";
    }
}
