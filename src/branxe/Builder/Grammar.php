<?php

namespace Branxe\Builder;

use Branxe\Builder\GrammarInterfaces\{Elements, Conditions};

class Grammar implements Elements, Conditions
{
    /**
     * @return string
     */
    public static function click(): string
    {
        return '.click()';
    }
}