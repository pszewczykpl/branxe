<?php

namespace Branxe\Grammar\JQuery;

use Branxe\Grammar\GrammarInterfaces\Finders as IFinders;

class Finder implements IFinders
{
    public static function findElementById(string $selector): string
    {
        return "$(\"#$selector\")";
    }

    public static function findElementByName(string $selector): string
    {
        return "$(\".$selector\")";
    }

    public static function findElementByTagName(string $selector): string
    {
        return "$(\"$selector\")";
    }

    public static function findElement(string $selector): string
    {
        return "$(\"$selector\")";
    }
}
