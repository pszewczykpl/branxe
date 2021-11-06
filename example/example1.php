<?php

require_once __DIR__.'/../vendor/autoload.php';

use Branxe\Grammar\JQuery\Element as E;

$script = Branxe\Script::create();
$script->insert(function ($driver) {
    $driver->findElementById('id_1')->click()->click();
    $driver->findElementById('id_2')->click();
    $driver->findElementById('id_3')->click();
    $driver->findElementById('id_1')->on('click', function ($driver) {
        $driver->findElementById('id_5')->click();
        $driver->findElementById('id_6')->click();
    });
    $driver->if('click', function ($driver) {
        $driver->findElementById('id_5')->click();
        $driver->findElementById('id_6')->click();
    });
});
$script->render();
