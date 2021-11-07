<?php

namespace Branxe\Grammar\JQuery;

use Branxe\Grammar\GrammarInterfaces\Elements as IElements;

class Element implements IElements
{
    public static function click(): string
    {
        return '.click()';
    }

    public static function blur(): string
    {
        return '.blur()';
    }

    public static function css(...$body): string
    {
        return '.css("' . implode('", "', ( is_array($body[0]) ? $body[0] : $body) ) . '")';
    }

    public static function change(): string
    {
        return '.change()';
    }
}
