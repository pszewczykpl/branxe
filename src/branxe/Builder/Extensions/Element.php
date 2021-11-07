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

    public function css($body)
    {
        $this->extendAction(".css(\"$body\")");
        return $this;
    }

    public function add($body)
    {
        $this->extendAction(".add(\"$body\")");
        return $this;
    }

    public function on($arg, $callback)
    {
        $this->extendAction(".on(\"$arg\", function() { ")->withoutSemicolon();
        $callback(new Driver($this->collection));
        $this->addAction(' }');

        return $this;
    }
}