<?php

namespace Branxe\Builder;

use Branxe\Action\ActionCollection;
use Branxe\Action\Action;

class BuilderExt
{
    protected ActionCollection $collection;

    public function __construct($collection)
    {
        $this->collection = $collection;
    }

    protected function addAction($body)
    {
        $action = new Action();
        $this->collection->insert($action);
        $action->insert($body);

        return $action;
    }

    protected function extendAction($body)
    {
        $action = $this->collection->getLast();
        $action->insert($body);

        return $action;
    }
}