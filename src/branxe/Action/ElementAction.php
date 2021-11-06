<?php

namespace Branxe\Action;

use Branxe\Grammar\Grammar;

class ElementAction extends Action
{
    /**
     * @param $selector
     */
    public function __construct($selector)
    {
        $this->insert($selector);
    }
}