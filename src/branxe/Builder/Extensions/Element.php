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
        $this->addToLastAction(E::click());
        return $this;
    }

    public function on($arg, $callback)
    {
        $this->addToLastAction(".on(\"$arg\", function() { ")->withoutSemicolon();
        $callback(new Driver($this->collection));
        $this->addAction(' }');

        return $this;
    }
}