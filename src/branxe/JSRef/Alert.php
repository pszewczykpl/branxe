<?php

namespace Branxe\JSRef;

use Branxe\JSRef\Interfaces\Finders as IFinders;

class Alert
{
    public static function alert(string $msg): string
    {
        return 'alert(' . $msg . ')';
    }
}
