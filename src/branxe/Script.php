<?php

namespace Branxe;

use Branxe\Builder\Builder;
use Branxe\Collection\ActionCollection;

class Script
{
    public static function create()
    {
        $collection = new ActionCollection();
        return new Builder($collection);
    }
}