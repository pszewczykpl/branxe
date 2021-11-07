<?php

namespace Branxe\Builder;

use Branxe\Action\{CustomAction, ElementAction};
use Branxe\Action\ActionCollection;
use Branxe\Grammar\Grammar;
use Branxe\Builder\Extensions\Driver;
use stdClass;

class Builder
{
    private ActionCollection $collection;
    private Driver $driver;

    /**
     * @param $collection
     */
    public function __construct($collection = null)
    {
        $collection = new ActionCollection();
        $this->collection = $collection;
    }

    /**
     *
     */
    public function render()
    {
        foreach($this->collection->getAll() as $item) {
            echo $item->renderAction();
        }
    }

    /**
     * @param $callback
     */
    public function insert($callback)
    {
        $callback(new Driver($this->collection));
    }
}