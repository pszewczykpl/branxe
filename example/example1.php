<?php

use Branxe\Script\Script;

require_once __DIR__.'/../vendor/autoload.php';

$script = new Script;
$script->insertMany(function ($action) {
    $action->find_element_by_id('id_1')->click()->click();
    $action->find_element_by_id('id_2')->click();
    $action->find_element_by_id('id_3')->click();
    $action->if('$("#id_4").length', function ($action) {
        $action->find_element_by_id('id_5')->click();
        $action->find_element_by_id('id_6')->click();
    });
});
$script->render();
