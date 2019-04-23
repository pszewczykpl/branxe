<?php

/*  
 *  Branxe @2019
 *  by Piotr Szewczyk
 *  
 *  Branxe kfskdjf 
 */
require_once('jquery-3.4.0.min.js.php');

class Identity {

    private $birthdayDate;

    /*
     * Insert data to the form
     * 
     * @since    0.0.1
     *
     * @param    array    $data['selector']     Name of jQuery selector
     * @param    array    $data['method']       Name of jQuery method (Available methods: val, click, prop, change)
     * @param    array    $data['property']     Only use in property jQuery method
     * @param    array    $data['value']        Value in jQuery methods
     *
     * @return   string                         Script completing the form in JavaScript
     */
    public function randomDate($startDate = '1901-01-01', $endDate = null, $format = 'Y-m-d') {

        if($endDate == null) { 
            $endDate = date('Y-m-d'); 
        }

        $min = strtotime($startDate);
        $max = strtotime($endDate);

        $date = mt_rand($min, $max);

        return date($format, $date);
    }

}

class Actions {

    private $script = '';

    /*
     * Insert data to the form
     * 
     * @since    0.0.1
     *
     * @param    array    $data['selector']     Name of jQuery selector
     * @param    array    $data['method']       Name of jQuery method (Available methods: val, click, prop, change)
     * @param    array    $data['property']     Only use in property jQuery method
     * @param    array    $data['value']        Value in jQuery methods
     *
     * @return   string                         Script completing the form in JavaScript
     */
    public function insert($data) {

        foreach ($data as $action) {
            $this->script .= $this->addSelector($action['selector']);

            switch($action['method']) {
                case 'value':
                    $this->script .= $this->valueMethod($action['value']);
                    break;
                case 'click':
                    $this->script .= $this->clickMethod();
                    break;
                case 'property':
                    $this->script .= $this->propertyMethod($action['property'], $action['value']);
                    break;
                case 'change':
                    $this->script .= $this->changeMethod();
                    break;
            }
        }
    }

    /*
     * Show complete JavaScript script
     * 
     * @since    0.0.1
     */
    public function returnScript() {

        return $this->script;
    }

    /*
     * Show complete JavaScript script
     * 
     * @since    0.0.1
     */
    public function renderScript() {

        echo $this->returnScript();
    }

    /*
     * Add selector in jQuery method
     * 
     * @since    0.0.1
     *
     * @param    string   $selector             Name of jQuery selector
     *
     * @return   string                         Selector in jQuery method
     */
    private function addSelector($selector) {

        return '$("' . $selector . '").';
    }

    /*
     * Add CSS style in jQuery method
     * 
     * @since    0.0.1
     *
     * @param    string   $propertyname         Propertyname of CSS style
     * @param    string   $value                Value of CSS style
     *
     * @return   string                         CSS style in jQuery method
     */
    private function addStyle($propertyname, $value) {

        return 'css("' . $propertyname . '", "' . $value . '");';
    }

    /*
     * Add jQuery method named val
     * 
     * @since    0.0.1
     *
     * @param    string   $value                Value in jQuery method
     *
     * @return   string                         jQuery method named val
     */
    private function valueMethod($value) {

        return 'val("' . $value . '");';
    }

    /*
     * Add jQuery method named click
     * 
     * @since    0.0.1
     *
     * @return   string                         jQuery method named click
     */
    private function clickMethod() {

        return 'click();';
    }

    /*
     * Add jQuery method named prop
     * 
     * @since    0.0.1
     *
     * @param    string   $property             Property in jQuery method
     * @param    string   $value                Value in jQuery method
     *
     * @return   string                         jQuery method named prop
     */
    private function propertyMethod($property, $value) {

        return 'prop("' . $property . '", ' . $value . ');';
    }

    /*
     * Add jQuery method named change
     * 
     * @since    0.0.1
     *
     * @return   string                         jQuery method named change
     */
    private function changeMethod() {

        return 'change();';
    }
}

$actions = new Actions();
$identity = new Identity();

/*
 * WNIOSEK: PRODUKT INWESTYCYJNY
 */
$actions->insert(array(

    array('selector' => '#test', 'method' => 'value', 'value' => $date),
    array('selector' => '#test2', 'method' => 'value', 'value' => 'Drugi testowy napis'),
    array('selector' => '#test3', 'method' => 'click'),
    array('selector' => '#test4', 'method' => 'property', 'property' => 'checked', 'value' => true)

));

$actions->renderScript();

?>