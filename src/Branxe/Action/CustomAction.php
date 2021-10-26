<?php

namespace Branxe\Action;

class CustomAction extends Action
{
    /**
     * @param $customCode
     */
    public function __construct($customCode)
    {
        parent::withoutSemicolon();
        array_push($this->code, $customCode);
    }
}