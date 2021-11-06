<?php

namespace Branxe\Action;

class CustomAction extends Action
{
    /**
     * @param $customCode
     */
    public function __construct($code)
    {
        $this->withoutSemicolon();
        $this->insert($code);
    }
}