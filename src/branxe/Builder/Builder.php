<?php

namespace Branxe\Builder;

use Branxe\Action\{CustomAction, ElementAction};
use Branxe\Collection\ActionCollection;

class Builder
{
    private ActionCollection $collection;
    protected Grammar $grammar;

    /**
     * @param $collection
     */
    public function __construct($collection)
    {
        $this->collection = $collection;
        $this->grammar = new Grammar();
    }

    /**
     * @param string $id
     * @return ElementAction
     */
    public function find_element_by_id(string $id): ElementAction
    {
        $element = new ElementAction('$("#' . $id . '")');
        $this->collection->insert($element);
        return $element;
    }

    /**
     * @param $if
     * @param $callback
     * @return $this
     */
    public function if($if, $callback)
    {
        $this->collection->insert(new CustomAction('if(' . $if . ') {'));
        $callback($this);
        $this->collection->insert(new CustomAction('}'));
        return $this;
    }
}