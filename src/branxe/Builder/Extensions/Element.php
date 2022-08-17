<?php

namespace Branxe\Builder\Extensions;

use Branxe\JSRef\Element as E;
use Branxe\Builder\BuilderExt;

class Element extends BuilderExt
{
    public function click(): Element
    {
        $this->extendAction(E::click());
        return $this;
    }

//    public function click(): Element
//    {
//        $this->extendAction('.dispatchEvent(new Event("change"))');
//        return $this;
//    }

    public function css(...$body)
    {
        $this->extendAction(E::css(...$body));
        return $this;
    }

    public function focus()
    {
        $this->extendAction('.focus()');
        return $this->builder;
    }

//    public function blur()
//    {
//        $this->extendAction(E::blur());
//        return $this->builder;
//    }

    public function change()
    {
        $this->extendAction(E::change());
        return $this;
    }

    public function value(string $value = '')
    {
        $this->extendAction('.value = "' . $value . '"');
        return $this;
    }

    public function append(string $append = '')
    {
        $this->extendAction(E::append($append));
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