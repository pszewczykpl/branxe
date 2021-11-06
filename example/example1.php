<?php

require_once __DIR__.'/../vendor/autoload.php';

$script = Branxe\Script::create();
$script->insertMany(function ($driver) {
    $driver->findElementById('id_1')->click()->click();
    $driver->findElementById('id_2')->click();
    $driver->findElementById('id_3')->click();
    $driver->if('$("#id_4").length', function ($driver) {
        $driver->findElementById('id_5')->click();
        $driver->findElementById('id_6')->click();
    });
});
$script->render();
