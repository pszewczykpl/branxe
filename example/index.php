<?php

require_once __DIR__.'/../vendor/autoload.php';

$script = Branxe\Script::create();
$script->conditions()->urlContains('formFill');
$script->insert(function ($driver) {
    $driver->findElementById('loginButton')->click();
    // $driver->alert("'Hi, this is: ' + window.location.href");
});
$script->render();

?>
$('#rodzaj_deklaracji').append(new Option('PELNA', 'PELNA'));
$('#rodzaj_deklaracji').val("PELNA").change();