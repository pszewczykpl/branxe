<?php

require_once __DIR__.'/../vendor/autoload.php';

use Branxe\Grammar\JQuery\Element as E;

$script = Branxe\Script::create();
$script->insert(function ($driver) {
    $driver->findElementById('id_1')->add('dupa')->css('jebać');
});
$script->render();
