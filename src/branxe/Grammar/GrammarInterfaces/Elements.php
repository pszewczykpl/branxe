<?php

namespace Branxe\Grammar\GrammarInterfaces;

interface Elements
{
    public static function click(): string;
    public static function css(...$body): string;
    public static function blur(): string;
    public static function change(): string;
    public static function value($value): string;
    public static function append($append): string;
}