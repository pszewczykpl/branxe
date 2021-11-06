<?php

namespace Branxe\Action;

class Action
{
    private array $code = [];
    private string $semicolon = ';';

    public function insert($code)
    {
        $this->code[] = $code;
    }

    public function renderAction(): string
    {
        return implode('', $this->code) . $this->semicolon;
    }

    public function withoutSemicolon()
    {
        $this->semicolon = '';
    }

    public function withSemicolon()
    {
        $this->semicolon = ';';
    }
}