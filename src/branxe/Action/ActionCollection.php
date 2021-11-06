<?php

namespace Branxe\Action;

use Branxe\Action\Action;

class ActionCollection
{
    private array $collection = [];

    public function getAll(): array
    {
        return $this->collection;
    }

    public function getLast()
    {
        return $this->collection[count($this->collection)-1];
    }

    public function insert(Action $action): static
    {
        array_push($this->collection, $action);

        return $this;
    }
}