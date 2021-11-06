<?php

namespace Branxe\Grammar\JQuery;

use Branxe\Grammar\GrammarInterfaces\Elements as IElements;

class Elements implements IElements
{
    /**
     * @return string
     */
    public static function click(): string
    {
        return '.click()';
    }

    public static function selector($selector): string
    {
        return "$(\"$selector\")";
    }
}
