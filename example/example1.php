<?php

require_once __DIR__.'/../vendor/autoload.php';

use Branxe\Grammar\JQuery\Element as E;

$script = Branxe\Script::create();
$script->insert(function ($driver) {
    // $driver->findElementById('id_1')->click()->on('click', 'dsds');
    // $driver->findElementById('id_2')->click();
    // $driver->findElementById('id_3')->click();
    $driver->findElementById('id_1')->on('click', function ($driver) {
        $driver->findElementById('id_5')->click();
        $driver->findElementById('id_6')->click();
    });
});
// $script->insert()->findElementById('ideks_1')->click();
$script->render();
