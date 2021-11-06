<?php

namespace Branxe\Builder\Extensions;

use Branxe\Action\Action;
use Branxe\Grammar\JQuery\Element as E;
use Branxe\Builder\BuilderExt;
use Branxe\Builder\Extensions\Driver;

class Element extends BuilderExt
{
    public function click()
    {
        $action = $this->collection->getLast();
        $action->insert(E::click());
        return $this;
    }

    public function on($arg, $callback)
    {
        $action = $this->collection->getLast();
        $action->insert(".on(\"$arg\", function() { ");
        $action->withoutSemicolon();

        $callback(new Driver($this->collection));

        $action2 = new Action();
        $action2->insert(' }');
        $this->collection->insert($action2);

        return $this;
    }
}