<?php

namespace Branxe\Builder\Extensions;

use Branxe\Action\Action;
use Branxe\Grammar\JQuery\Element as E;
use Branxe\Builder\BuilderExt;

class Driver extends BuilderExt
{
    public function findElementById(string $id)
    {
        $this->addAction(E::findElementById($id));
        return new Element($this->collection);
    }

    public function if($if, $callback)
    {
        $this->addAction('if(' . $if . ') { ')->withoutSemicolon();
        $callback($this);
        $this->addAction(' }');

        return $this;
    }
}
