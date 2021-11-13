<?php

namespace Branxe\Builder\Extensions;

use Branxe\Action\Action;
use Branxe\JSRef\{Finder as F, Alert as A, Document as D};
use Branxe\JQueryRef\{JQuery, Selector as By};
use Branxe\Builder\BuilderExt;

class Driver extends BuilderExt
{
    /**
     * Find element on page by ID
     *
     * @param string $selector
     * @return Element
     */
    public function findElementById(string $selector): Element
    {
        $this->addAction(JQuery::find(By::id($selector)));
        return new Element($this->builder);
    }

    /**
     * Find element on page by name
     *
     * @param string $selector
     * @return Element
     */
    public function findElementByName(string $selector): Element
    {
        $this->addAction(JQuery::find(By::name($selector)));
        return new Element($this->builder);
    }

    /**
     * Find element on page by tag name
     *
     * @param string $selector
     * @return Element
     */
    public function findElementByTagName(string $selector): Element
    {
        $this->addAction(JQuery::find(By::tagName($selector)));
        return new Element($this->builder);
    }

    /**
     * Find element on page by custom jQuery selector
     *
     * @param string $selector
     * @return Element
     */
    public function findElementByCustom(string $selector): Element
    {
        $this->addAction(JQuery::find(By::custom($selector)));
        return new Element($this->builder);
    }

    public function exec(string $code)
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
