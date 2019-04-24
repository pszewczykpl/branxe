<?php

/*  
 *  Branxe @2019
 *  by Piotr Szewczyk
 *  
 *  Branxe kfskdjf 
 */
require_once('jquery-3.4.0.min.js.php');

class Identity {

    private $_birthdayDate;
    private $_sex;
    private $_pesel;

    public function __construct() {
        $this->generatePesel();
    }

    /*
     * Return the set birthday date
     * 
     * @since    0.0.1
     */
    public function getBirthdayDate() {

        return $this->_birthdayDate;
    }

    /*
     * Return the set sex
     * 
     * @since    0.0.1
     */
    public function getSex() {

        return $this->_sex;
    }

    /*
     * Return sex
     * 
     * @since    0.0.1
     */
    private function generateSex() {

        switch($this->randomNumber()) {
            case 0:
                return 'man';
                break;
            case 1:
                return 'woman';
                break;
        }
    }

    /*
     * Return the set pesel
     * 
     * @since    0.0.1
     */
    public function getPesel() {

        return $this->_pesel;
    }

    /*
     * Return pesel
     * 
     * @since    0.0.1
     */
    private function generatePesel($birthdayDate = null, $sex = null) {

        if(!$birthdayDate) {
            $birthdayDate = $this->randomDate();
        }
        if(!$sex) {
            $sex = $this->generateSex();
        }

        $year = date('y', strtotime($birthdayDate));
        $fullYear = date('Y', strtotime($birthdayDate));
        $month = date('m', strtotime($birthdayDate));
        $day = date('d', strtotime($birthdayDate));

        if($fullYear >= 1800 && $fullYear <= 1899) {
            $month += 80;
        }
        else if($fullYear >= 2000 && $fullYear <= 2099) {
            $month += 20;
        }
        else if($fullYear >= 2100 && $fullYear <= 2199) {
            $month += 40;
        }
        else if($fullYear >= 2200 && $fullYear <= 2299) {
            $month += 60;
        }

        $even = [0, 2, 4, 6, 8];

        $this->_pesel = $year;
        $this->_pesel .= $month;
        $this->_pesel .= $day;
        $this->_pesel .= $this->randomNumber(0,9);
        $this->_pesel .= $this->randomNumber(0,9);
        $this->_pesel .= $this->randomNumber(0,9);
        
        if($sex == 'woman') {
            $this->_pesel .= $even[$this->randomNumber(0,4)];
        }
        else {
            $this->_pesel .= $even[$this->randomNumber(0,4)]+1;
        }
    }

    /*
     * Return random date
     * 
     * @since    0.0.1
     */
    private function randomDate($start = null, $end = null, $format = 'Y-m-d') {

        if(!$start) {
            $start = '1901-01-01';
        }
        if(!$end) {
            $end = date('Y-m-d');
        }

        return date($format, mt_rand(strtotime($start), strtotime($end)));
    }

    /*
     * Return random number
     * 
     * @since    0.0.1
     */
    private function randomNumber($min = 0, $max = 1) {

        return rand($min, $max);
    }
}

class Actions {

    private $_script = '';

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
            $this->_script .= $this->addSelector($action['selector']);

            switch($action['method']) {
                case 'value':
                    $this->_script .= $this->valueMethod($action['value']);
                    break;
                case 'click':
                    $this->_script .= $this->clickMethod();
                    break;
                case 'property':
                    $this->_script .= $this->propertyMethod($action['property'], $action['value']);
                    break;
                case 'change':
                    $this->_script .= $this->changeMethod();
                    break;
            }
        }
    }

    /*
     * Return complete JavaScript script
     * 
     * @since    0.0.1
     */
    public function getScript() {

        return $this->_script;
    }

    /*
     * Show complete JavaScript script
     * 
     * @since    0.0.1
     */
    public function renderScript() {

        echo $this->getScript();
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

    array('selector' => '#test', 'method' => 'value', 'value' => $identity->getPesel()),
    array('selector' => '#test2', 'method' => 'value', 'value' => 'Drugi testowy napis'),
    array('selector' => '#test3', 'method' => 'click'),
    array('selector' => '#test4', 'method' => 'property', 'property' => 'checked', 'value' => true)

));

$actions->renderScript();

?>