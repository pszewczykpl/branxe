<?php

namespace Branxe\Script;

use Branxe\Grammar\Builder;
use Branxe\Collection\ActionCollection;

class Script
{
    /**
     * @var Builder
     */
    public Builder $builder;

    /**
     * @var ActionCollection
     */
    public ActionCollection $collection;

    /**
     *
     */
    public function __construct()
    {
        $this->collection = new ActionCollection();
        $this->builder = new Builder($this->collection);
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
    public function insert(): Builder
    {
        return $this->builder;
    }

    /**
     * @param $callback
     */
    public function insertMany($callback)
    {
        $callback($this->builder);
    }
}