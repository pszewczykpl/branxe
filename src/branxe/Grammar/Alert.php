<?php

namespace Branxe\Grammar;

use Branxe\Grammar\GrammarInterfaces\Finders as IFinders;

class Alert
{
    public static function alert(string $msg): string
    {
        return 'alert(' . $msg . ')';
    }
}
