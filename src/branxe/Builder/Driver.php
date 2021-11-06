<?php

namespace Branxe\Builder;

use Branxe\Action\{CustomAction, ElementAction};
use Branxe\Collection\ActionCollection;
use Branxe\Grammar\JQuery\Elements as GrammarElements;

class Driver
{
    private ActionCollection $collection;

    public function __construct($collection)
    {
        $this->collection = $collection;
    }

    /**
     * @param string $id
     * @return Element
     */
    public function findElementById(string $id): Element
    {
        $element = new ElementAction(GrammarElements::selector('#' . $id));
        $this->collection->insert($element);
        return new Element($element);
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