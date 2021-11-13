<?php

namespace Branxe\JQueryRef;

class JQuery
{
    public static function find(string $selector)
    {
        return "$(\"$selector\")";
    }
}
