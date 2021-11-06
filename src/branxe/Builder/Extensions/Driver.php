<?php

namespace Branxe\Builder\Extensions;

use Branxe\Action\Action;
use Branxe\Grammar\JQuery\Element as E;
use Branxe\Builder\BuilderExt;

class Driver extends BuilderExt
{
    public function findElementById(string $id)
    {
        $action = new Action();
        $action->insert(E::findElementById($id));
        $this->collection->insert($action);
        return new Element($this->collection);
    }

    // public function if($if, $callback)
    // {
    //     $this->collection->insert(new CustomAction('if(' . $if . ') { '));
    //     $callback($this);
    //     $this->collection->insert(new CustomAction(' }'));
    //     return $this;
    // }
}
