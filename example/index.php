<?php

require_once __DIR__.'/../vendor/autoload.php';

use Branxe\JSRef\Option;

$script = Branxe\Script::create();
$script->url()->contains('formFill');

$script->insert(function ($driver) {
    $driver->findElementById('rodzaj_deklaracji')->append(Option::new('Pełny(wypełnianie on-line)', 'PELNA'));
    $driver->findElementById('rodzaj_deklaracji')->value('PELNA')->click();
//    $driver->findElementById('rodzaj_deklaracji')->blur();
});
$script->render();