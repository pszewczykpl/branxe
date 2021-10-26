<?php

namespace Branxe\Action;

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
        array_push($this->code, '.click()');
        return $this;
    }
}