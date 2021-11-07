<?php

namespace Branxe;

use Branxe\Builder\Builder;

class Script
{
    public static function create()
    {
        return new Builder();
    }
}