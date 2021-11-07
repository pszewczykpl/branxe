<?php

namespace Branxe\Builder\Extensions;

use Branxe\Grammar\JQuery\Element as E;
use Branxe\Builder\BuilderExt;
use Branxe\Builder\Extensions\Driver;

class Element extends BuilderExt
{
    public function click()
    {
        $this->extendAction(E::click());
        return $this;
    }

    public function css(...$body)
    {
        $this->extendAction(E::css(...$body));
        return $this;
    }

    public function blur()
    {
        $this->extendAction(E::blur());
        return $this;
    }

    public function change()
    {
        $this->extendAction(E::change());
        return $this;
    }

    public function on($arg, $callback)
    {
        $this->extendAction(".on(\"$arg\", function() { ")->withoutSemicolon();
        $callback(new Driver($this->builder));
        $this->addAction(' }');

        return $this;
    }
}