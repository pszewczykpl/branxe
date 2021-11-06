<?php

namespace Branxe\Builder;

use Branxe\Action\Action;
use Branxe\Grammar\JQuery\Elements as GrammarElements;

class Element
{
    private Action $action;
    
    public function __construct($action)
    {
        $this->action = $action;
    }

    public function click()
    {
        $this->action->insert(GrammarElements::click());
        return $this;
    }
}