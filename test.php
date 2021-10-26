<?php

use Branxe\Script\Script;

require __DIR__.'/vendor/autoload.php';

$script = new Script;
$script->insertMany(function ($action) {
    $action->find_element_by_id('dupa')->click()->click();
    $action->find_element_by_id('dupa1')->click();
    $action->find_element_by_id('dupa2')->click();
    $action->if('$("#dupa").length', function ($action) {
        $action->find_element_by_id('dupa3')->click();
        $action->find_element_by_id('dupa4')->click();
    });
});

$script->render();
