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
    public function withoutSemicolon(): static
    {
        $this->semicolon = '';

        return $this;
    }
}