<?php

namespace Branxe\Builder;

use Branxe\Action\Action;

class BuilderExt
{
    protected Builder $builder;

    public function __construct($builder)
    {
        $this->builder = $builder;
    }

    protected function addAction($body)
    {
        $action = new Action();
        $this->builder->getCollection()->insert($action);
        $action->insert($body);

        return $action;
    }

    protected function extendAction($body)
    {
        $action = $this->builder->getCollection()->getLast();
        $action->insert($body);

        return $action;
    }
}