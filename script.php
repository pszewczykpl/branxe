<?php

/*  
 *  Branxe @2019
 *  by Piotr Szewczyk
 *  
 *  Branxe kfskdjf 
 */
require_once('jquery-3.4.0.min.js.php');
require_once('database.php');

class Identity {

	/* Imię */
	private $_name;
	/* Drugie imię */
	private $_secondName;
	/* Nazwisko */
    private $_surname;
    /* Data urodzenia */
	private $_birthdayDate;
	/* Obywatelstwo */
	private $_citizenship;
	/* Płeć */
    private $_sex;
    /* PESEL */
    private $_pesel;
    /* Rodzaj dokumentu tożsamości (dowód osobisty) */
    private $_idCardType = 1;
    /* Nazwa rodzaju dokumentu tożsamości (dowód osobisty) */
    private $_idCardTypeName;
    /* Numer dokumentu tożsamości (dowód osobisty) */
    private $_idCardNumber;
    /* Rodzaj dokumentu tożsamości (paszport) */
    private $_passportCardType = 2;
    /* Nazwa rodzaju dokumentu tożsamości (paszport) */
    private $_passportCardTypeName;
    /* Numer dokumentu tożsamości (paszport) */
    private $_passportCardNumber;
    /* Nazwa urzędu skarbowego (dla Polski) */
    private $_taxOfficeNamePL;
    /* Numer rachunku bankowego */
    private $_bankAccountNumber;
    

    public function __construct() {

    	global $database;

    	$this->generateBirthdayDate();
    	$this->generateSex();
        $this->generatePesel();
        $this->generateNames($database);
        $this->generateSurname($database);
        $this->generatePassportCardTypeName($database);
        $this->generatePassportCardNumber();
        $this->generateIdCardTypeName($database);
        $this->generateIdCardNumber();    
        $this->generateTaxOfficeName($database);
        $this->generateBankAccountNumber();
    
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
     * Generate birthday date and set $this->_birthdayDate;
     * 
     * @since    0.0.1
     */
    private function generateBirthdayDate() {

        $this->_birthdayDate = $this->randomDate();
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
     * Generate sex and set $this->_sex;
     * 
     * @since    0.0.1
     */
    private function generateSex() {

        switch($this->randomNumber()) {
            case 0:
                $this->_sex = 'man';
                break;
            case 1:
                $this->_sex = 'woman';
                break;
        }
    }

    /*
     * Return the set name
     * 
     * @since    0.0.1
     */
    public function getName() {

        return $this->_name;
    }

    /*
     * Return the set second name
     * 
     * @since    0.0.1
     */
    public function getSecondName() {

        return $this->_secondName;
    }

    /*
     * Generate name and set $this->_name;
     * 
     * @since    0.0.1
     */
    private function generateNames($data) {

    	switch($this->_sex) {
    		case 'man':
    			$this->_name = $data['male_names'][$this->randomNumber(0, $this->lengthArray($data['male_names']))];
    			$this->_secondName = $data['male_names'][$this->randomNumber(0, $this->lengthArray($data['male_names']))];
    			while($this->_name == $this->_secondName) {
    				$this->_secondName = $data['male_names'][$this->randomNumber(0, $this->lengthArray($data['male_names']))];
    			}
    			break;
    		case 'woman':
    			$this->_name = $data['famale_names'][$this->randomNumber(0, $this->lengthArray($data['famale_names']))];
    			$this->_secondName = $data['famale_names'][$this->randomNumber(0, $this->lengthArray($data['famale_names']))];
    			while($this->_name == $this->_secondName) {
    				$this->_secondName = $data['famale_names'][$this->randomNumber(0, $this->lengthArray($data['famale_names']))];
    			}
    			break;
    	}
        
    }

    /*
     * Return the set surname
     * 
     * @since    0.0.1
     */
    public function getSurname() {

        return $this->_surname;
    }

    /*
     * Generate surname and set $this->_surname;
     * 
     * @since    0.0.1
     */
    private function generateSurname($data) {

    	switch($this->_sex) {
    		case 'man':
    			$this->_surname = $data['male_surnames'][$this->randomNumber(0, $this->lengthArray($data['male_surnames']))];
    			break;
    		case 'woman':
    			$this->_surname = $data['famale_surnames'][$this->randomNumber(0, $this->lengthArray($data['famale_surnames']))];
    			break;
    	}
        
    }

    /*
     * Return the set tax office name
     * 
     * @since    0.0.1
     */
    public function getTaxOfficeName() {

        return $this->_taxOfficeNamePL;
    }

    /*
     * Generate tax office name and set $this->_taxOfficeNamePL;
     * 
     * @since    0.0.1
     */
    private function generateTaxOfficeName($data) {

    	$this->_taxOfficeNamePL = $data['tax_offices_PL'][$this->randomNumber(0, $this->lengthArray($data['tax_offices_PL']))];
    }

    /*
     * Return the set ID card number
     * 
     * @since    0.0.1
     */
    public function getIdCardNumber() {

        return $this->_idCardNumber;
    }

    /*
     * Return the set ID card type
     * 
     * @since    0.0.1
     */
    public function getIdCardType() {

        return $this->_idCardType;
    }

    /*
     * Return the set name of ID card type
     * 
     * @since    0.0.1
     */
    public function getIdCardTypeName() {

        return $this->_idCardTypeName;
    }

    /*
     * Generate ID card type name
     * 
     * @since    0.0.1
     */
    public function generateIdCardTypeName($data) {

        $this->_idCardTypeName = $data['identification_card_type'][$this->_idCardType];
    }

    /*
     * Generate ID card number and set $this->_idCardNumber;
     * 
     * @since    0.0.1
     */
    private function generateIdCardNumber() {

    	$values = array( 0 => 0, 1 => 1, 2 => 2, 3 => 3, 4 => 4, 5 => 5, 6 => 6, 7 => 7, 8 => 8, 9 => 9, 'A' => 10, 'B' => 11, 'C' => 12, 'D' => 13, 'E' => 14, 'F' => 15, 'G' => 16, 'H' => 17, 'I' => 18, 'J' => 19, 'K' => 20, 'L' => 21, 'M' => 22, 'N' => 23, 'O' => 24, 'P' => 25, 'Q' => 26, 'R' => 27, 'S' => 28, 'T' => 29, 'U' => 30, 'V' => 31, 'W' => 32, 'X' => 33, 'Y' => 34, 'Z' => 35);
    	$weights = [7, 3, 1, 7, 3, 1, 7, 3];

    	$series = $this->randomChar(3);
    	$number = $this->randomNumber(0,9,5);
    	$seriesNumber = $series . $number;
    	$control_sum = 0;

    	for($i = 0; $i < 8; $i++) {
    		$control_sum += $values[substr($seriesNumber, $i, 1)] * $weights[$i];
    	}
    	$control_sum %= 10;

    	$this->_idCardNumber  = $series;
    	$this->_idCardNumber .= $control_sum;
    	$this->_idCardNumber .= $number;
    }

    /*
     * Get bank account number
     * 
     * @since    0.0.1
     */
    public function getBankAccountNumber() {

    	return $this->_bankAccountNumber;
    }

    /*
     * Generate bank account number and set $this->_bankAccountNumber;
     * 
     * @since    0.0.1
     */
    private function generateBankAccountNumber() {

    	$values = array( 0 => 0, 1 => 1, 2 => 2, 3 => 3, 4 => 4, 5 => 5, 6 => 6, 7 => 7, 8 => 8, 9 => 9, 'A' => 10, 'B' => 11, 'C' => 12, 'D' => 13, 'E' => 14, 'F' => 15, 'G' => 16, 'H' => 17, 'I' => 18, 'J' => 19, 'K' => 20, 'L' => 21, 'M' => 22, 'N' => 23, 'O' => 24, 'P' => 25, 'Q' => 26, 'R' => 27, 'S' => 28, 'T' => 29, 'U' => 30, 'V' => 31, 'W' => 32, 'X' => 33, 'Y' => 34, 'Z' => 35);

    	for($i = 0; $i<=10; $i++) {

    		$number = "";
    		$mod = 1;

    		while($mod != 0) {
    			$number = $this->randomNumber(0,9,2);
	    		$mod = $number % 97;
	    	}
	    	$this->_bankAccountNumber .= $number;
    	}

    	$number1 = "";
    	$mod1 = 1;
    }

    /*
     * Return the set passport card number
     * 
     * @since    0.0.1
     */
    public function getPassportCardNumber() {

        return $this->_passportCardNumber;
    }

    /*
     * Return the set passport card type
     * 
     * @since    0.0.1
     */
    public function getPassportCardType() {

        return $this->_passportCardType;
    }

    /*
     * Return the set name of passport card type
     * 
     * @since    0.0.1
     */
    public function getPassportCardTypeName() {

        return $this->_passportCardTypeName;
    }

    /*
     * Generate passport card type name
     * 
     * @since    0.0.1
     */
    public function generatePassportCardTypeName($data) {

        $this->_passportCardTypeName = $data['identification_card_type'][$this->_passportCardType];
    }

    /*
     * Generate passport card number and set $this->_passportCardNumber;
     * 
     * @since    0.0.1
     */
    private function generatePassportCardNumber() {

    	$values = array( 0 => 0, 1 => 1, 2 => 2, 3 => 3, 4 => 4, 5 => 5, 6 => 6, 7 => 7, 8 => 8, 9 => 9, 'A' => 10, 'B' => 11, 'C' => 12, 'D' => 13, 'E' => 14, 'F' => 15, 'G' => 16, 'H' => 17, 'I' => 18, 'J' => 19, 'K' => 20, 'L' => 21, 'M' => 22, 'N' => 23, 'O' => 24, 'P' => 25, 'Q' => 26, 'R' => 27, 'S' => 28, 'T' => 29, 'U' => 30, 'V' => 31, 'W' => 32, 'X' => 33, 'Y' => 34, 'Z' => 35);
    	$weights = [7, 3, 1, 7, 3, 1, 7, 3];

    	$series = $this->randomChar(2);
    	$number = $this->randomNumber(0,9,6);
    	$seriesNumber = $series . $number;
    	$control_sum = 0;

    	for($i = 0; $i < 8; $i++) {
    		$control_sum += $values[substr($seriesNumber, $i, 1)] * $weights[$i];
    	}
    	$control_sum %= 10;

    	$this->_passportCardNumber  = $series;
    	$this->_passportCardNumber .= $control_sum;
    	$this->_passportCardNumber .= $number;
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
     * Generate pesel and set $this->_pesel;
     * 
     * @since    0.0.1
     */
    private function generatePesel() {

    	$even = [0, 2, 4, 6, 8];
        $weights = [1, 3, 7, 9, 1, 3, 7, 9, 1, 3];
        $control_sum = 0;
        $year = date('y', strtotime($this->_birthdayDate));
        $fullYear = date('Y', strtotime($this->_birthdayDate));
        $month = date('m', strtotime($this->_birthdayDate));
        $day = date('d', strtotime($this->_birthdayDate));

        if($fullYear >= 1800 && $fullYear <= 1899) 		$month += 80;
        else if($fullYear >= 2000 && $fullYear <= 2099) $month += 20;
        else if($fullYear >= 2100 && $fullYear <= 2199) $month += 40;
        else if($fullYear >= 2200 && $fullYear <= 2299) $month += 60;

        $this->_pesel = $year . $month . $day . $this->randomNumber(0,9,3);
        
        switch($this->_sex) {
        	case 'woman':
        		$this->_pesel .= $even[$this->randomNumber(0,4)];
        		break;
        	case 'man':
        		$this->_pesel .= $even[$this->randomNumber(0,4)]+1;
        		break;
        }

        for($i = 0; $i<=9; $i++) {
        	$control_sum += $weights[$i] * substr($this->_pesel, $i, 1);
        }

        $this->_pesel .= (10 - ($control_sum % 10)) % 10;
    }

    /*
     * Return random date
     * 
     * @since    0.0.1
     */
    private function randomDate($start = '1901-01-01', $end = '2003-01-01', $format = 'Y-m-d') {

        return date($format, mt_rand(strtotime($start), strtotime($end)));
    }

    /*
     * Return random number
     * 
     * @since    0.0.1
     */
    private function randomNumber($min = 0, $max = 1, $length = 1) {

    	$number = "";

    	for($i = 0; $i<$length; $i++) {
    		$number .= rand($min, $max);
    	}

        return $number;
    }

    /*
     * Return random char
     *
     * @since    0.0.1
     */
    private function randomChar($length = 1) {

    	$chars = Array ('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z');
    	$char = "";

    	for($i = 0; $i<$length; $i++) {
    		$char .= $chars[rand(0, 25)];
    	}

        return $char;
    }

    /*
     * Return lenght array
     *
     * @since    0.0.1
     */
    private function lengthArray($data) {

    	$lenght = -1;

    	foreach ($data as $values) {
    		$lenght++;
    	}

        return $lenght;
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

	/* Czy Ubezpieczający i Ubezpieczony to różne osoby? */
    array('selector' => '#notSamePerson0', 'method' => 'click'), /* TAK */

    /* Czy została wypełniona Ankieta potrzeb klienta? (Ubezpieczony) */
	array('selector' => '#insuredPollFilled0', 'method' => 'click'), 
	array('selector' => '#insuredPollFilled0', 'method' => 'change'), 
	array('selector' => '#insuredPositiveRecommendation0', 'method' => 'click'), 
	array('selector' => '#insuredPositiveRecommendation0', 'method' => 'change'), 
	array('selector' => '#insuredRecommendationSelected0', 'method' => 'click'), 
	array('selector' => '#insuredRecommendationSelected0', 'method' => 'change'),
	array('selector' => '#insuredPollUpToDate0', 'method' => 'click'), 
	array('selector' => '#insuredPollUpToDate0', 'method' => 'change'), 

	/* Czy została wypełniona Ankieta potrzeb klienta? (Ubezpieczający) */
	array('selector' => '#insurerPollFilled0', 'method' => 'click'), 
	array('selector' => '#insurerPollFilled0', 'method' => 'change'), 
	array('selector' => '#insurerPositiveRecommendation0', 'method' => 'click'), 
	array('selector' => '#insurerPositiveRecommendation0', 'method' => 'change'), 
	array('selector' => '#insurerRecommendationSelected0', 'method' => 'click'), 
	array('selector' => '#insurerRecommendationSelected0', 'method' => 'change'),
	array('selector' => '#insurerPollUpToDate0', 'method' => 'click'),
	array('selector' => '#insurerPollUpToDate0', 'method' => 'change'),

	array('selector' => '#imie_uc', 'method' => 'value', 'value' => $identity->getName()),
	array('selector' => '#drugie_imie_uc', 'method' => 'value', 'value' => $identity->getSecondName()),
	array('selector' => '#nazwisko_uc', 'method' => 'value', 'value' => $identity->getSurname()),
    array('selector' => '#pesel_uc', 'method' => 'value', 'value' => $identity->getPesel()),
    array('selector' => '#data_urodzenia_uc', 'method' => 'value', 'value' => $identity->getBirthdayDate()),
    array('selector' => '#rodzaj_dok_pol_uc', 'method' => 'value', 'value' => $identity->getIdCardType()),
    array('selector' => '#nr_dok_tozsamosci_uc', 'method' => 'value', 'value' => $identity->getIdCardNumber()),
    array('selector' => '#urzad_skarbowy_slownik_uc', 'method' => 'value', 'value' => $identity->getTaxOfficeName()),
    array('selector' => '#nr_rachunku_ubez_uc', 'method' => 'value', 'value' => $identity->getBankAccountNumber()),
    array('selector' => '#test3', 'method' => 'click'),
    array('selector' => '#test4', 'method' => 'property', 'property' => 'checked', 'value' => true)

));

$identity = new Identity();
	
/*
 * WNIOSEK: PRODUKT INWESTYCYJNY
 */
$actions->insert(array(

	array('selector' => '#odbiorca_imie_os_trzecia', 'method' => 'value', 'value' => $identity->getName()),
	array('selector' => '#odbiorca_nazwisko_os_trzecia', 'method' => 'value', 'value' => $identity->getSurname()),
    array('selector' => '#adres_ulica_os_trzecia', 'method' => 'value', 'value' => "Ulica"),
    array('selector' => '#adres_nr_domu_os_trzecia', 'method' => 'value', 'value' => "1"),
    array('selector' => '#adres_nr_lokalu_os_trzecia', 'method' => 'value', 'value' => "1"),
    array('selector' => '#adres_miejscowosc_os_trzecia', 'method' => 'value', 'value' => "Miejscowość"),
    array('selector' => '#adres_kod_os_trzecia', 'method' => 'value', 'value' => "11-111"),
    array('selector' => '#adres_poczta_os_trzecia', 'method' => 'value', 'value' => "Poczta"),
    array('selector' => '#adres_kraj_os_trzecia', 'method' => 'value', 'value' => "PL"),
    array('selector' => '#adres_k_ulica_os_trzecia', 'method' => 'value', 'value' => "Ulica"),
    array('selector' => '#adres_k_nr_domu_os_trzecia', 'method' => 'value', 'value' => "1"),
    array('selector' => '#adres_k_nr_lokalu_os_trzecia', 'method' => 'value', 'value' => "1"),
    array('selector' => '#adres_k_miejscowosc_os_trzecia', 'method' => 'value', 'value' => "Miejscowość"),
    array('selector' => '#adres_k_kod_os_trzecia', 'method' => 'value', 'value' => "11-111"),
    array('selector' => '#adres_k_poczta_os_trzecia', 'method' => 'value', 'value' => "Poczta"),
    array('selector' => '#adres_k_kraj_os_trzecia', 'method' => 'value', 'value' => "PL"),
    array('selector' => '#nr_rachunku_os_trzecia', 'method' => 'value', 'value' => "26249000056450941321968339")


));

$actions->renderScript();

?>

document.body.onkeyup = function(e){
    if(e.keyCode == 32){
        $("#button_next").click();
        $("#finish").click();
        $("#s3").click();
        $("#s2").click();
    }
}