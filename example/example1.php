<?php

require_once __DIR__.'/../vendor/autoload.php';

use Branxe\Grammar\JQuery\Element as E;

$script = Branxe\Script::create();
$script->insert(function ($driver) {
    $driver->findElementByName('123')->css('1', '2', 3.3);
    $driver->findElementById('123')->click();
    $driver->findElementById('123')->blur();
});
$script->render();
