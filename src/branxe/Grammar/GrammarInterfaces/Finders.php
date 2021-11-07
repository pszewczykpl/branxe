<?php

namespace Branxe\Grammar\GrammarInterfaces;

interface Finders
{
    public static function findElementById(string $selector): string;
    public static function findElementByName(string $selector): string;
    public static function findElementByTagName(string $selector): string;
    public static function findElement(string $selector): string;
}