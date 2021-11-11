<?php

namespace Branxe\Builder;

use Branxe\Action\ActionCollection;
use Branxe\Builder\Extensions\Driver;
use stdClass;

class Builder
{
    protected ActionCollection $collection;

    public array $conditions = [];

    public function __construct($collection = null)
    {
        $collection = new ActionCollection();
        $this->collection = $collection;
    }

    public function getCollection()
    {
        return $this->collection;
    }

    public function conditions()
    {
        return new class($this) {

            private Builder $builder;

            public function __construct($builder)
            {
                $this->builder = $builder;
            }

            public function urlContains($url)
            {
                $this->builder->conditions[] = 'window.location.href.includes("' . $url . '")';

                return $this;
            }

            public function urlEqual($url)
            {
                $this->builder->conditions[] = 'window.location.href == "' . $url . '"';

                return $this;
            }
        };
    }

    public function render()
    {
        if(! $this->conditions == []) echo 'if( ' . implode(' && ', $this->conditions) . ' ) { ';

        foreach($this->collection->getAll() as $item) {
            echo $item->renderAction();
        }

        if(! $this->conditions == []) echo ' }';
    }

    public function insert($callback)
    {
        $callback(new Driver($this));
    }
}