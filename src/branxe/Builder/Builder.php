<?php

namespace Branxe\Builder;

use Branxe\Action\{CustomAction, ElementAction};
use Branxe\Collection\ActionCollection;
use Branxe\Grammar\Grammar;

class Builder
{
    private ActionCollection $collection;
    private Driver $driver;

    /**
     * @param $collection
     */
    public function __construct($collection)
    {
        $this->collection = $collection;
        $this->driver = new Driver($this->collection);
    }

    /**
     *
     */
    public function render()
    {
        foreach($this->collection->get() as $item) {
            echo $item->renderAction();
        }
    }

    /**
     * @return Builder
     */
    public function insert()
    {
        return $this->driver;
    }

    /**
     * @param $callback
     */
    public function insertMany($callback)
    {
        $callback($this->driver);
    }
}