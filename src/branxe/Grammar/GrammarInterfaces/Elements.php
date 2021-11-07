<?php

namespace Branxe\Grammar\GrammarInterfaces;

interface Elements
{
    public static function click(): string;
    public static function css(...$body): string;
    public static function blur(): string;
}