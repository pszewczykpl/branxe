<?php

namespace Branxe\Builder;

use Branxe\Action\{CustomAction, ElementAction};
use Branxe\Action\ActionCollection;
use Branxe\Grammar\Grammar;
use Branxe\Builder\Extensions\Driver;
use stdClass;

class Builder
{
    protected ActionCollection $collection;

    public function __construct($collection = null)
    {
        $collection = new ActionCollection();
        $this->collection = $collection;
    }

    public function getCollection()
    {
        return $this->collection;
    }

    public function render()
    {
        foreach($this->collection->getAll() as $item) {
            echo $item->renderAction();
        }
    }

    public function insert($callback)
    {
        $callback(new Driver($this));
    }
}