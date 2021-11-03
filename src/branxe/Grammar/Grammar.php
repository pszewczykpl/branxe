<?php

namespace Branxe\Grammar;

use Branxe\Grammar\GrammarInterfaces\{Elements, Conditions};

class Grammar implements Elements, Conditions
{
    /**
     * @return string
     */
    public static function click(): string
    {
        return '.click()';
    }

    /**
     * @return string
     */
    public static function if(): string
    {
        return '.click()';
    }

    /**
     * @return string
     */
    public static function endif(): string
    {
        return '.click()';
    }
}

(new Grammar('dup'))::click();