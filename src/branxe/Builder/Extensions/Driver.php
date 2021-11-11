<?php

namespace Branxe\Builder\Extensions;

use Branxe\Action\Action;
use Branxe\Grammar\{Finder as F, Alert as A};
use Branxe\Builder\BuilderExt;

class Driver extends BuilderExt
{
    public function findElementById(string $selector)
    {
        $this->addAction(F::findElementById($selector));
        return new Element($this->builder);
    }

    public function findElementByName(string $selector)
    {
        $this->addAction(F::findElementByName($selector));
        return new Element($this->builder);
    }

    public function findElementByTagName(string $selector)
    {
        $this->addAction(F::findElementByTagName($selector));
        return new Element($this->builder);
    }

    public function findElement(string $selector)
    {
        $this->addAction(F::findElement($selector));
        return new Element($this->builder);
    }

    public function custom(string $code)
    {
        $this->addAction($code);

        return $this;
    }

    public function alert(string $msg)
    {
        $this->addAction(A::alert($msg));

        return $this;
    }

    public function if($if, $callback)
    {
        $this->addAction('if(' . $if . ') { ')->withoutSemicolon();
        $callback($this);
        $this->addAction(' }');

        return $this;
    }
}
