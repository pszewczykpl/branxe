<?php

namespace Branxe\JSRef;

class Document
{
    public static function querySelector(string $selector)
    {
        return "document.querySelector(\"$selector\")";
    }

    public static function querySelectorAll(string $selector)
    {
        return "document.querySelectorAll(\"$selector\")";
    }

    public static function getElementById(string $selector)
    {
        return "document.getElementById(\"$selector\")";
    }
}
