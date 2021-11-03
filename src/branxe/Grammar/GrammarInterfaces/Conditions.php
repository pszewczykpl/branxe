<?php

namespace Branxe\Grammar\GrammarInterfaces;

interface Conditions
{
    public static function if(): string;
    public static function endif(): string;
}