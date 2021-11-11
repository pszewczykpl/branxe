<?php

namespace Branxe\Grammar\JQuery;

use Branxe\Grammar\GrammarInterfaces\Finders as IFinders;

class Alert
{
    public static function alert(string $msg): string
    {
        return 'alert(' . $msg . ')';
    }
}
