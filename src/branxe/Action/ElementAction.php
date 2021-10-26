<?php

namespace Branxe\Action;

use Branxe\Builder\Grammar;

class ElementAction extends Action
{
    /**
     * @var string
     */
    public string $selector;

    /**
     * @param $selector
     */
    public function __construct($selector)
    {
        $this->selector = $selector;
        array_push($this->code, $selector);
    }

    /**
     * @return $this
     */
    public function click()
    {
        array_push($this->code, Grammar::click());
        return $this;
    }
}