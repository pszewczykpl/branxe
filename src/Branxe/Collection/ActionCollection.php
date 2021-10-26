<?php

namespace Branxe\Collection;

use Branxe\Action\Action;

class ActionCollection
{
    /**
     * @var array
     */
    private array $collection = array();

    /**
     * @return array
     */
    public function get(): array
    {
        return $this->collection;
    }

    /**
     * @param Action $action
     * @return $this
     */
    public function insert(Action $action): static
    {
        array_push($this->collection, $action);

        return $this;
    }
}