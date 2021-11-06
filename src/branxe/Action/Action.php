<?php

namespace Branxe\Action;

abstract class Action
{
    /**
     * @var array
     */
    protected array $code = array();

    /**
     * @var string
     */
    private string $semicolon = ';';

    public function insert($code)
    {
        array_push($this->code, $code);
    }

    /**
     * @return string
     */
    public function renderAction(): string
    {
        return implode('', $this->code) . $this->semicolon;
    }

    /**
     * @return $this
     */
    public function withoutSemicolon()
    {
        $this->semicolon = '';
    }
}