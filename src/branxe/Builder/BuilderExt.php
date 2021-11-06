<?php

namespace Branxe\Builder;

use Branxe\Action\ActionCollection;

class BuilderExt
{
    protected ActionCollection $collection;

    public function __construct($collection)
    {
        $this->collection = $collection;
    }
}