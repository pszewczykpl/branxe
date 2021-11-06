<?php

namespace Branxe\Grammar\JQuery;

use Branxe\Grammar\GrammarInterfaces\Elements as IElements;

class Element implements IElements
{
    /**
     * @return string
     */
    public static function click(): string
    {
        return '.click()';
    }

    public static function findElementById($selector): string
    {
        return "$(\"#$selector\")";
    }
}
