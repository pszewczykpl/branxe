<?php

namespace Branxe\JQueryRef;

class Element
{
    public static function click(): string
    {
        return '.click()';
    }

    public static function blur(): string
    {
        return '.blur()';
    }

    public static function keyup(): string
    {
        return '.keyup()';
    }

    public static function css(...$body): string
    {
        return '.css("' . implode('", "', ( is_array($body[0]) ? $body[0] : $body) ) . '")';
    }

    public static function change(): string
    {
        return '.change()';
    }

    public static function val($value): string
    {
        return '.val("' . $value . '")';
    }

    public static function append($append): string
    {
        return ".append($append)";
    }
}
