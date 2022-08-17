<?php

namespace Branxe\Builder\Extensions;

use Branxe\JQueryRef\{JQuery, Selector as By};
use Branxe\JSRef\{Document, Finder};
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
//        $this->addAction(JQuery::find(By::id($selector)));
        $this->addAction(Document::getElementById($selector));
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
}
