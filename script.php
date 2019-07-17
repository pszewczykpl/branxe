document.body.onkeyup=function(e){if(e.keyCode == 192){$("#button_next").click();$("#finish").click();$("#s3").click();$("#s2").click();}}

if ($("#rodzaj_deklaracji").length) { 
$('#rodzaj_deklaracji').append(new Option('PELNA', 'PELNA'));
}
<?php
 ob_start();

function setCookies($name, $value, $sec) {

    setcookie($name, $value, time()+$sec);
    return true;
}

function getCookies($name) {

    if(isset($_COOKIE[$name])) {
        return $_COOKIE[$name];
    }
    return false;
}

/*  
 *  Branxe @2019
 *  by Piotr Szewczyk
 *  
 *  Branxe kfskdjf 
 */


require('Database.php');


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
                $this->_sex = 'M';
                break;
            case 1:
                $this->_sex = 'K';
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
    		case 'M':
    			$this->_name = $data['male_names'][$this->randomNumber(0, $this->lengthArray($data['male_names']))];
    			$this->_secondName = $data['male_names'][$this->randomNumber(0, $this->lengthArray($data['male_names']))];
    			while($this->_name == $this->_secondName) {
    				$this->_secondName = $data['male_names'][$this->randomNumber(0, $this->lengthArray($data['male_names']))];
    			}
    			break;
    		case 'K':
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
    		case 'M':
    			$this->_surname = $data['male_surnames'][$this->randomNumber(0, $this->lengthArray($data['male_surnames']))];
    			break;
    		case 'K':
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
        	case 'K':
        		$this->_pesel .= $even[$this->randomNumber(0,4)];
        		break;
        	case 'M':
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
    private function randomDate($start = '1960-01-01', $end = '1996-01-01', $format = 'Y-m-d') {

        return date($format, mt_rand(strtotime($start), strtotime($end)));
    }

    /*
     * Return random number
     * 
     * @since    0.0.1
     */
    public function randomNumber($min = 0, $max = 1, $length = 1) {

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

    public function randomArray($data) {

        $lenght = $this->lengthArray($data);

        return $data[$this->randomNumber(0, $lenght)];
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
            switch($action['method']) {
                case 'value':
                    $this->_script .= $this->addSelector($action['selector']);
                    $this->_script .= $this->valueMethod($action['value']);
                    break;
                case 'click':
                    $this->_script .= $this->addSelector($action['selector']);
                    $this->_script .= $this->clickMethod();
                    break;
                case 'property':
                    $this->_script .= $this->addSelector($action['selector']);
                    $this->_script .= $this->propertyMethod($action['property'], $action['value']);
                    break;
                case 'change':
                    $this->_script .= $this->addSelector($action['selector']);
                    $this->_script .= $this->changeMethod();
                    break;
                case 'blur':
                    $this->_script .= $this->addSelector($action['selector']);
                    $this->_script .= $this->blurMethod();
                    break;
                case 'focus':
                    $this->_script .= $this->addSelector($action['selector']);
                    $this->_script .= $this->focusMethod();
                    break;
                case 'keyup':
                    $this->_script .= $this->addSelector($action['selector']);
                    $this->_script .= $this->keyupMethod();
                    break;
                case 'checked':
                    $this->_script .= 'if ($("';
                    $this->_script .= $action['selector'];
                    $this->_script .= '").length) { $("';
                    $this->_script .= $action['selector'];
                    $this->_script .= '")[0].checked = "';
                    $this->_script .= $action['value'];
                    $this->_script .= '"; }';
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
     * Add jQuery method named blur
     * 
     * @since    0.0.1
     *
     * @return   string                         jQuery method named blur
     */
    private function blurMethod() {

        return 'blur();';
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

        return 'if ($("' . $property . '").length) { prop("' . $property . '","' . $value . '"); }';
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

    /*
     * Add jQuery method named keyup
     * 
     * @since    0.0.1
     *
     * @return   string                         jQuery method named keyup
     */
    private function keyupMethod() {

        return 'keyup();';
    }

    /*
     * Add jQuery method named focus
     * 
     * @since    0.0.1
     *
     * @return   string                         jQuery method named focus
     */
    private function focusMethod() {

        return 'focus();';
    }
}

$actions = new Actions();
$identity = new Identity();
$identity2 = new Identity();
$identity3 = new Identity();
$identity4 = new Identity();
$procentage = $identity3->randomArray($database['dane_procenty']);



/*
 * Wniosek (Produkty Inwestycyjne + Ochronne)
 */
$actions->insert(array(

	/* Czy Ubezpieczający i Ubezpieczony to różne osoby? */
    array('selector' => '#notSamePerson0', 'method' => 'click'), /* TAK */

    /* Pytania dla Ubezpieczonego */
	array('selector' => '#insuredPollFilled0', 'method' => 'click'), 
	array('selector' => '#insuredPollFilled0', 'method' => 'change'), 
	array('selector' => '#insuredPositiveRecommendation0', 'method' => 'click'), 
	array('selector' => '#insuredPositiveRecommendation0', 'method' => 'change'), 
	array('selector' => '#insuredRecommendationSelected0', 'method' => 'click'), 
	array('selector' => '#insuredRecommendationSelected0', 'method' => 'change'),
	array('selector' => '#insuredPollUpToDate0', 'method' => 'click'), 
	array('selector' => '#insuredPollUpToDate0', 'method' => 'change'), 

	/* Pytania dla Ubezpieczającego */
	array('selector' => '#insurerPollFilled0', 'method' => 'click'), 
	array('selector' => '#insurerPollFilled0', 'method' => 'change'), 
	array('selector' => '#insurerPositiveRecommendation0', 'method' => 'click'), 
	array('selector' => '#insurerPositiveRecommendation0', 'method' => 'change'), 
	array('selector' => '#insurerRecommendationSelected0', 'method' => 'click'), 
	array('selector' => '#insurerRecommendationSelected0', 'method' => 'change'),
	array('selector' => '#insurerPollUpToDate0', 'method' => 'click'),
	array('selector' => '#insurerPollUpToDate0', 'method' => 'change'),

    /* Dane dotyczące Ubezpieczającego */
	array('selector' => '#imie_uc', 'method' => 'value', 'value' => $identity->getName()),
	array('selector' => '#drugie_imie_uc', 'method' => 'value', 'value' => $identity->getSecondName()),
	array('selector' => '#nazwisko_uc', 'method' => 'value', 'value' => $identity->getSurname()),
    array('selector' => '#pesel_uc', 'method' => 'value', 'value' => $identity->getPesel()),
    array('selector' => '#data_urodzenia_uc', 'method' => 'value', 'value' => $identity->getBirthdayDate()),
    array('selector' => '#plec_uc', 'method' => 'value', 'value' => $identity->getSex()),
    array('selector' => '#obywatelstwo_uc', 'method' => 'value', 'value' => 'PL'),
    array('selector' => '#rodzaj_dok_inne_uc', 'method' => 'value', 'value' => $identity->getIdCardType()),
    array('selector' => '#rodzaj_dok_pol_uc', 'method' => 'value', 'value' => $identity->getIdCardType()),
    array('selector' => '#nr_dok_tozsamosci_uc', 'method' => 'value', 'value' => $identity->getIdCardNumber()),
    array('selector' => '#urzad_skarbowy_slownik_uc', 'method' => 'value', 'value' => $identity->getTaxOfficeName()),
    array('selector' => '#nr_rachunku_ubez_uc', 'method' => 'value', 'value' => $identity->randomArray($database['dane_nr_rachunku_bankowego'])),
    array('selector' => '#nazwa_banku_uc', 'method' => 'value', 'value' => 'Getin Noble Bank S.A.'),
    array('selector' => '#adres_z_ulica_uc', 'method' => 'value', 'value' => $identity->randomArray($database['dane_ulice'])),
    array('selector' => '#adres_z_nr_domu_uc', 'method' => 'value', 'value' => $identity->randomNumber(0,120)),
    array('selector' => '#adres_z_nr_lokalu_uc', 'method' => 'value', 'value' => $identity->randomNumber(0,120)),
    array('selector' => '#adres_z_kod_uc', 'method' => 'value', 'value' => $identity->randomArray($database['dane_kod_pocztowy'])),
    array('selector' => '#adres_z_poczta_uc', 'method' => 'value', 'value' => $identity->randomArray($database['dane_poczta'])),
    array('selector' => '#adres_z_miejscowosc_uc', 'method' => 'value', 'value' => 'Warszawa'),
    array('selector' => '#adres_k_ulica_uc', 'method' => 'value', 'value' => $identity->randomArray($database['dane_ulice'])),
    array('selector' => '#adres_k_nr_domu_uc', 'method' => 'value', 'value' => $identity->randomNumber(0,120)),
    array('selector' => '#adres_k_nr_lokalu_uc', 'method' => 'value', 'value' => $identity->randomNumber(0,120)),
    array('selector' => '#adres_k_kod_uc', 'method' => 'value', 'value' => $identity->randomArray($database['dane_kod_pocztowy'])),
    array('selector' => '#adres_k_poczta_uc', 'method' => 'value', 'value' => $identity->randomArray($database['dane_poczta'])),
    array('selector' => '#adres_k_miejscowosc_uc', 'method' => 'value', 'value' => 'Warszawa'),
    array('selector' => '#telefon_stac_dom_uc', 'method' => 'value', 'value' => '+48220000000'),
    array('selector' => '#telefon_stac_praca_uc', 'method' => 'value', 'value' => '+48220000000'),
    array('selector' => '#telefon_kom_uc', 'method' => 'value', 'value' => '+48781910516'),
    array('selector' => '#email_uc', 'method' => 'value', 'value' => 'anna.zaliwska@openlife.pl'),
    array('selector' => '#podatnik_usa_uc', 'method' => 'value', 'value' => 'N'),
    array('selector' => '#miejsce_urodzenia_uc', 'method' => 'value', 'value' => 'Łódź'),
    array('selector' => '#kraj_urodzenia_uc', 'method' => 'value', 'value' => 'PL'),
    array('selector' => '#posiada_rezydencje_uc', 'method' => 'value', 'value' => 'N'),

    /* Dane dotyczące Ubezpieczonego */
	array('selector' => '#imie', 'method' => 'value', 'value' => $identity2->getName()),
	array('selector' => '#drugie_imie', 'method' => 'value', 'value' => $identity2->getSecondName()),
	array('selector' => '#nazwisko', 'method' => 'value', 'value' => $identity2->getSurname()),
    array('selector' => '#pesel', 'method' => 'value', 'value' => $identity2->getPesel()),
    array('selector' => '#data_urodzenia', 'method' => 'value', 'value' => $identity2->getBirthdayDate()),
    array('selector' => '#plec', 'method' => 'value', 'value' => $identity2->getSex()),
    array('selector' => '#obywatelstwo', 'method' => 'value', 'value' => 'PL'),
    array('selector' => '#rodzaj_dok_inne', 'method' => 'value', 'value' => $identity2->getIdCardType()),
    array('selector' => '#rodzaj_dok_pol', 'method' => 'value', 'value' => $identity2->getIdCardType()),
    array('selector' => '#nr_dok_tozsamosci', 'method' => 'value', 'value' => $identity2->getIdCardNumber()),
    array('selector' => '#urzad_skarbowy_slownik', 'method' => 'value', 'value' => $identity2->getTaxOfficeName()),
    array('selector' => '#nr_rachunku_ubez', 'method' => 'value', 'value' => $identity2->randomArray($database['dane_nr_rachunku_bankowego'])),
    array('selector' => '#nazwa_banku', 'method' => 'value', 'value' => 'Getin Noble Bank S.A.'),
    array('selector' => '#adres_z_ulica', 'method' => 'value', 'value' => $identity2->randomArray($database['dane_ulice'])),
    array('selector' => '#adres_z_nr_domu', 'method' => 'value', 'value' => $identity2->randomNumber(0,120)),
    array('selector' => '#adres_z_nr_lokalu', 'method' => 'value', 'value' => $identity2->randomNumber(0,120)),
    array('selector' => '#adres_z_kod', 'method' => 'value', 'value' => $identity2->randomArray($database['dane_kod_pocztowy'])),
    array('selector' => '#adres_z_poczta', 'method' => 'value', 'value' => $identity2->randomArray($database['dane_poczta'])),
    array('selector' => '#adres_z_miejscowosc', 'method' => 'value', 'value' => 'Warszawa'),
    array('selector' => '#adres_k_ulica', 'method' => 'value', 'value' => $identity2->randomArray($database['dane_ulice'])),
    array('selector' => '#adres_k_nr_domu', 'method' => 'value', 'value' => $identity2->randomNumber(0,120)),
    array('selector' => '#adres_k_nr_lokalu', 'method' => 'value', 'value' => $identity2->randomNumber(0,120)),
    array('selector' => '#adres_k_kod', 'method' => 'value', 'value' => $identity2->randomArray($database['dane_kod_pocztowy'])),
    array('selector' => '#adres_k_poczta', 'method' => 'value', 'value' => $identity2->randomArray($database['dane_poczta'])),
    array('selector' => '#adres_k_miejscowosc', 'method' => 'value', 'value' => 'Warszawa'),
    array('selector' => '#telefon_stac_dom', 'method' => 'value', 'value' => '+48220000000'),
    array('selector' => '#telefon_stac_praca', 'method' => 'value', 'value' => '+48220000000'),
    array('selector' => '#telefon_kom', 'method' => 'value', 'value' => '+48781910516'),
    array('selector' => '#email', 'method' => 'value', 'value' => 'anna.zaliwska@openlife.pl'),
    array('selector' => '#podatnik_usa', 'method' => 'value', 'value' => 'N'),
    array('selector' => '#miejsce_urodzenia', 'method' => 'value', 'value' => 'Łódź'),
    array('selector' => '#kraj_urodzenia', 'method' => 'value', 'value' => 'PL'),
    array('selector' => '#posiada_rezydencje', 'method' => 'value', 'value' => 'N'),
    array('selector' => '#zawod_wyk', 'method' => 'value', 'value' => 'Prawnik'),
    array('selector' => '#dz_gosp', 'method' => 'value', 'value' => '10'),
    array('selector' => '#zakres_ob', 'method' => 'value', 'value' => 'Prawnikowanie'),

    /* Ankieta medyczna dotycząca stanu zdrowia */
    array('selector' => '#wzrost', 'method' => 'value', 'value' => $identity3->randomNumber(165,195)),
    array('selector' => '#waga', 'method' => 'value', 'value' => $identity3->randomNumber(55,95)),
    array('selector' => '#cisnienie_wyzsze', 'method' => 'value', 'value' => '120'),
    array('selector' => '#cisnienie_nizsze', 'method' => 'value', 'value' => '80'),

    array('selector' => '#ub_ank_med_1N', 'method' => 'checked', 'value' => 'true'),
    array('selector' => '#ub_ank_med_2N', 'method' => 'checked', 'value' => 'true'),
    array('selector' => '#ub_ank_med_3N', 'method' => 'checked', 'value' => 'true'),
    array('selector' => '#ub_ank_med_4N', 'method' => 'checked', 'value' => 'true'),
    array('selector' => '#ub_ank_med_5N', 'method' => 'checked', 'value' => 'true'),
    array('selector' => '#ub_ank_med_6N', 'method' => 'checked', 'value' => 'true'),
    array('selector' => '#ub_ank_med_7N', 'method' => 'checked', 'value' => 'true'),
    array('selector' => '#ub_ank_med_8N', 'method' => 'checked', 'value' => 'true'),
    array('selector' => '#ub_ank_med_9N', 'method' => 'checked', 'value' => 'true'),

    /* Dane dotyczące Ubezpieczenia */
    array('selector' => '#skladka', 'method' => 'value', 'value' => '50000'),
    array('selector' => '#skladka', 'method' => 'blur'),
    array('selector' => '#skladka', 'method' => 'focus'),
    array('selector' => '#skladka', 'method' => 'keyup'),
    array('selector' => '#skladka', 'method' => 'change'),
    array('selector' => '#oplata_transakcyjna', 'method' => 'blur'),
    array('selector' => '#oplata_transakcyjna', 'method' => 'focus'),
    array('selector' => '#oplata_transakcyjna', 'method' => 'keyup'),
    array('selector' => '#oplata_transakcyjna', 'method' => 'change'),
    array('selector' => '#wariant_skladkowy', 'method' => 'blur'),
    array('selector' => '#wariant_skladkowy', 'method' => 'focus'),
    array('selector' => '#wariant_skladkowy', 'method' => 'keyup'),
    array('selector' => '#wariant_skladkowy', 'method' => 'change'),
    array('selector' => '#fundusze_0_nazwa_funduszu', 'method' => 'value', 'value' => 'FOLAG002'),
    array('selector' => '#fundusze_0_nazwa_funduszu', 'method' => 'change'),
    array('selector' => '#fundusze_0_alokacja_text', 'method' => 'value', 'value' => '100'),

    /* Umowa podstawowa */
    array('selector' => '#ub_suma_ubezp', 'method' => 'value', 'value' => '500000'),
    array('selector' => '#ub_suma_ubezp', 'method' => 'blur'),
    array('selector' => '#ub_suma_ubezp', 'method' => 'keyup'),
    array('selector' => '#ub_suma_ubezp', 'method' => 'change'),

    /* Umowa dodatkowa */
    array('selector' => '#ub_dod_nw', 'method' => 'checked', 'value' => 'true'),
    array('selector' => '#ub_dod_nw', 'method' => 'blur'),
    array('selector' => '#ub_dod_nw', 'method' => 'keyup'),
    array('selector' => '#ub_dod_nw', 'method' => 'change'),
    array('selector' => '#ub_sm_nw', 'method' => 'value', 'value' => '500000'),
    array('selector' => '#ub_sm_nw', 'method' => 'blur'),
    array('selector' => '#ub_sm_nw', 'method' => 'keyup'),
    array('selector' => '#ub_sm_nw', 'method' => 'change'),

    array('selector' => '#ub_dod_ti', 'method' => 'checked', 'value' => 'true'),
    array('selector' => '#ub_dod_ti', 'method' => 'blur'),
    array('selector' => '#ub_dod_ti', 'method' => 'keyup'),
    array('selector' => '#ub_dod_ti', 'method' => 'change'),
    array('selector' => '#ub_trw_inw', 'method' => 'value', 'value' => '250000'),
    array('selector' => '#ub_trw_inw', 'method' => 'blur'),
    array('selector' => '#ub_trw_inw', 'method' => 'keyup'),
    array('selector' => '#ub_trw_inw', 'method' => 'change'),

    array('selector' => '#ub_dod_ch', 'method' => 'checked', 'value' => 'true'),
    array('selector' => '#ub_dod_ch', 'method' => 'blur'),
    array('selector' => '#ub_dod_ch', 'method' => 'keyup'),
    array('selector' => '#ub_dod_ch', 'method' => 'change'),
    array('selector' => '#ub_ciez_chor', 'method' => 'value', 'value' => '150000'),
    array('selector' => '#ub_ciez_chor', 'method' => 'blur'),
    array('selector' => '#ub_ciez_chor', 'method' => 'keyup'),
    array('selector' => '#ub_ciez_chor', 'method' => 'change'),

    array('selector' => '#ub_dod_sz', 'method' => 'checked', 'value' => 'true'),
    array('selector' => '#ub_dod_sz', 'method' => 'blur'),
    array('selector' => '#ub_dod_sz', 'method' => 'keyup'),
    array('selector' => '#ub_dod_sz', 'method' => 'change'),
    array('selector' => '#ub_pob_szpital', 'method' => 'value', 'value' => '200'),
    array('selector' => '#ub_pob_szpital', 'method' => 'blur'),
    array('selector' => '#ub_pob_szpital', 'method' => 'keyup'),
    array('selector' => '#ub_pob_szpital', 'method' => 'change'),

    array('selector' => '#uc_pokr_agent2', 'method' => 'value', 'value' => '6'),

    /* Dane uposażonych */
    array('selector' => '#uprawnieni_0_u_typ', 'method' => 'value', 'value' => '1'),
    array('selector' => '#uprawnieni_0_u_typ', 'method' => 'change'),
    array('selector' => '#uprawnieni_1_u_typ', 'method' => 'value', 'value' => '2'),
    array('selector' => '#uprawnieni_1_u_typ', 'method' => 'change'),
    array('selector' => '#uprawnieni_0_u_imie', 'method' => 'value', 'value' => $identity3->getName()),
    array('selector' => '#uprawnieni_0_u_drugie_imie', 'method' => 'value', 'value' => $identity3->getSecondName()),
    array('selector' => '#uprawnieni_0_u_nazwisko', 'method' => 'value', 'value' => $identity3->getSurname()),
    array('selector' => '#uprawnieni_0_u_pesel', 'method' => 'value', 'value' => $identity3->getPesel()),
    array('selector' => '#uprawnieni_0_u_plec', 'method' => 'value', 'value' => $identity3->getSex()),
    array('selector' => '#uprawnieni_0_u_data_urodzenia', 'method' => 'value', 'value' => $identity3->getBirthdayDate()),
    array('selector' => '#uprawnieni_0_u_pokrewienstwo', 'method' => 'value', 'value' => $identity3->randomArray($database['dane_pokrewienstwa'])),
    array('selector' => '#uprawnieni_0_u_procent', 'method' => 'value', 'value' => $procentage),
    
    array('selector' => '#uprawnieni_1_u_regon', 'method' => 'value', 'value' => '237987346'),
    array('selector' => '#uprawnieni_1_u_nazwa', 'method' => 'value', 'value' => $identity3->randomArray($database['dane_nazwy'])),
    array('selector' => '#uprawnieni_1_u_procent', 'method' => 'value', 'value' => 100-$procentage),

    array('selector' => '#uprawnieni_0_typ', 'method' => 'value', 'value' => '1'),
    array('selector' => '#uprawnieni_0_typ', 'method' => 'change'),
    array('selector' => '#uprawnieni_1_typ', 'method' => 'value', 'value' => '2'),
    array('selector' => '#uprawnieni_1_typ', 'method' => 'change'),
    array('selector' => '#uprawnieni_0_imie', 'method' => 'value', 'value' => $identity3->getName()),
    array('selector' => '#uprawnieni_0_drugie_imie', 'method' => 'value', 'value' => $identity3->getSecondName()),
    array('selector' => '#uprawnieni_0_nazwisko', 'method' => 'value', 'value' => $identity3->getSurname()),
    array('selector' => '#uprawnieni_0_pesel', 'method' => 'value', 'value' => $identity3->getPesel()),
    array('selector' => '#uprawnieni_0_plec', 'method' => 'value', 'value' => $identity3->getSex()),
    array('selector' => '#uprawnieni_0_data_urodzenia', 'method' => 'value', 'value' => $identity3->getBirthdayDate()),
    array('selector' => '#uprawnieni_0_pokrewienstwo', 'method' => 'value', 'value' => $identity3->randomArray($database['dane_pokrewienstwa'])),
    array('selector' => '#uprawnieni_0_procent', 'method' => 'value', 'value' => $procentage),
    
    array('selector' => '#uprawnieni_1_regon', 'method' => 'value', 'value' => '237987346'),
    array('selector' => '#uprawnieni_1_nazwa', 'method' => 'value', 'value' => $identity3->randomArray($database['dane_nazwy'])),
    array('selector' => '#uprawnieni_1_procent', 'method' => 'value', 'value' => 100-$procentage),

    /* AML */
    array('selector' => '#wlasciciel_srodkow', 'method' => 'value', 'value' => 'T'),
    array('selector' => '#wlasciciel_srodkow', 'method' => 'change'),
    array('selector' => '#srodki_finansowe_pochodzenie', 'method' => 'value', 'value' => '1'),
    array('selector' => '#srodki_finansowe_pochodzenie', 'method' => 'change'),
    array('selector' => '#stanowisko_polityczne', 'method' => 'value', 'value' => 'N'),
    array('selector' => '#stanowisko_polityczne', 'method' => 'change'),

    /* Oświadczenia Ubezpieczającego */
    array('selector' => '#indeksacja_tak_uc', 'method' => 'checked', 'value' => 'true'),
    array('selector' => '#oferty_handlowe_tak_uc', 'method' => 'checked', 'value' => 'true'),
    array('selector' => '#przekazywanie_informacji_tak_uc', 'method' => 'checked', 'value' => 'true'),
    array('selector' => '#przetwarzanie_danych_tak_uc', 'method' => 'checked', 'value' => 'true'),
    array('selector' => '#marketing_bezposredni_tak_uc', 'method' => 'checked', 'value' => 'true'),
    array('selector' => '#oferty_handlowe_tak', 'method' => 'checked', 'value' => 'true'),
    array('selector' => '#przekazywanie_informacji_tak', 'method' => 'checked', 'value' => 'true'),
    array('selector' => '#przekazanie_wersji_papierowej', 'method' => 'checked', 'value' => 'true'),
    array('selector' => '#przetwarzanie_danych_tak', 'method' => 'checked', 'value' => 'true'),
    array('selector' => '#marketing_bezposredni_tak', 'method' => 'checked', 'value' => 'true'),
    array('selector' => '#kontroferta_nie_uc', 'method' => 'checked', 'value' => 'true'),
    array('selector' => '#przetwarzanie_stan_zdrowia_a_tak', 'method' => 'checked', 'value' => 'true'),
    array('selector' => '#przetwarzanie_stan_zdrowia_b_tak', 'method' => 'checked', 'value' => 'true'),

    /* Kwestionariusz Medyczny */
    array('selector' => '#km_0_N', 'method' => 'checked', 'value' => 'true'),
    array('selector' => '#km_1_N', 'method' => 'checked', 'value' => 'true'),
    array('selector' => '#km_2_N', 'method' => 'checked', 'value' => 'true'),
    array('selector' => '#km_3_N', 'method' => 'checked', 'value' => 'true'),
    array('selector' => '#km_4_N', 'method' => 'checked', 'value' => 'true'),
    array('selector' => '#km_5_N', 'method' => 'checked', 'value' => 'true'),
    array('selector' => '#km_6_N', 'method' => 'checked', 'value' => 'true'),
    array('selector' => '#km_6A_N', 'method' => 'checked', 'value' => 'true'),
    array('selector' => '#km_6B_N', 'method' => 'checked', 'value' => 'true'),
    array('selector' => '#km_6C_N', 'method' => 'checked', 'value' => 'true'),
    array('selector' => '#km_6D_N', 'method' => 'checked', 'value' => 'true'),
    array('selector' => '#km_6E_N', 'method' => 'checked', 'value' => 'true'),
    array('selector' => '#km_6F_N', 'method' => 'checked', 'value' => 'true'),
    array('selector' => '#km_6G_N', 'method' => 'checked', 'value' => 'true'),
    array('selector' => '#km_6H_N', 'method' => 'checked', 'value' => 'true'),
    array('selector' => '#km_6I_N', 'method' => 'checked', 'value' => 'true'),
    array('selector' => '#km_6J_N', 'method' => 'checked', 'value' => 'true'),
    array('selector' => '#km_6K_N', 'method' => 'checked', 'value' => 'true'),
    array('selector' => '#km_6L_N', 'method' => 'checked', 'value' => 'true'),
    array('selector' => '#km_6M_N', 'method' => 'checked', 'value' => 'true'),
    array('selector' => '#km_7_N', 'method' => 'checked', 'value' => 'true'),
    array('selector' => '#km_8_N', 'method' => 'checked', 'value' => 'true'),
    array('selector' => '#km_9_N', 'method' => 'checked', 'value' => 'true'),
    array('selector' => '#km_10_N', 'method' => 'checked', 'value' => 'true'),
    array('selector' => '#km_11_N', 'method' => 'checked', 'value' => 'true'),
    array('selector' => '#km_12_N', 'method' => 'checked', 'value' => 'true'),
    array('selector' => '#km_13_N', 'method' => 'checked', 'value' => 'true'),
    array('selector' => '#km_14_N', 'method' => 'checked', 'value' => 'true'),
    array('selector' => '#km_15_N', 'method' => 'checked', 'value' => 'true'),
    array('selector' => '#km_16_N', 'method' => 'checked', 'value' => 'true'),

	array('selector' => '#odbiorca_imie_os_trzecia', 'method' => 'value', 'value' => $identity4->getName()),
	array('selector' => '#odbiorca_nazwisko_os_trzecia', 'method' => 'value', 'value' => $identity4->getSurname()),
    array('selector' => '#adres_ulica_os_trzecia', 'method' => 'value', 'value' => "Ulica"),
    array('selector' => '#adres_nr_domu_os_trzecia', 'method' => 'value', 'value' => "1"),
    array('selector' => '#adres_nr_lokalu_os_trzecia', 'method' => 'value', 'value' => "1"),
    array('selector' => '#zawod_wyk', 'method' => 'value', 'value' => "Miejscowość"),
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
    array('selector' => '#nr_rachunku_os_trzecia', 'method' => 'value', 'value' => "26249000056450941321968339"),

    array('selector' => '#protectiveType1', 'method' => 'checked', 'value' => 'true'),
    array('selector' => '#samePerson1', 'method' => 'checked', 'value' => 'true'),
    array('selector' => '#zgoda_ankieta_wypelnia_tak', 'method' => 'checked', 'value' => 'true'),
    array('selector' => '#przekazywanie_danych_tak', 'method' => 'checked', 'value' => 'true'),
    array('selector' => '#dostep_internet_tak', 'method' => 'checked', 'value' => 'true'),
    array('selector' => '#q2_a3', 'method' => 'checked', 'value' => 'true'),
    array('selector' => '#q3_a3', 'method' => 'checked', 'value' => 'true'),
    array('selector' => '#q4_a6', 'method' => 'checked', 'value' => 'true'),
    array('selector' => '#q5_a5', 'method' => 'checked', 'value' => 'true'),
    
    array('selector' => '#q10_a1', 'method' => 'checked', 'value' => 'true'),
    array('selector' => '#q11_a5', 'method' => 'checked', 'value' => 'true'),
    array('selector' => '#q12_a1', 'method' => 'value', 'value' => $identity->randomNumber(3,6,2)),
    array('selector' => '#q13_a1_tak', 'method' => 'checked', 'value' => 'true'),
    array('selector' => '#q13_a2_tak', 'method' => 'checked', 'value' => 'true'),
    array('selector' => '#q14_a5', 'method' => 'checked', 'value' => 'true'),
    array('selector' => '#q7_a4', 'method' => 'checked', 'value' => 'true'),
    array('selector' => '#q8_a1_nie', 'method' => 'checked', 'value' => 'true'),
    array('selector' => '#q8_a2_nie', 'method' => 'checked', 'value' => 'true'),
    array('selector' => '#q8_a3_tak', 'method' => 'checked', 'value' => 'true'),
    array('selector' => '#q8_a4_tak', 'method' => 'checked', 'value' => 'true'),
    array('selector' => '#q8_a5_tak', 'method' => 'checked', 'value' => 'true'),
    array('selector' => '#q8_a6_tak', 'method' => 'checked', 'value' => 'true'),
    array('selector' => '#q9_a1_tak', 'method' => 'checked', 'value' => 'true'),
    array('selector' => '#q9_a2_tak_elem_nie', 'method' => 'checked', 'value' => 'true'),
    array('selector' => '#q9_a3_tak_elem_nie', 'method' => 'checked', 'value' => 'true'),
    array('selector' => '#q9_a4_tak_elem_tak', 'method' => 'checked', 'value' => 'true'),
    array('selector' => '#q13_a2_tak', 'method' => 'checked', 'value' => 'true'),



    array('selector' => '#insurerPesel', 'method' => 'value', 'value' => $identity3->getPesel()),
    array('selector' => '#insuredPesel', 'method' => 'value', 'value' => $identity3->getPesel()),
    array('selector' => '#dokument_tozsamosci_rodzaj', 'method' => 'value', 'value' => $identity2->getIdCardType()),
    array('selector' => '#dokument_tozsamosci_numer', 'method' => 'value', 'value' => $identity2->getIdCardNumber())

));

$cookies = getCookies('branxe_next_stage');

if($cookies!='ok') {
    $actions->insert(array(
        array('selector' => '#l_uprawnionych', 'method' => 'value', 'value' => '2'),
        array('selector' => '#l_uprawnionych', 'method' => 'change'),
        array('selector' => '#l_funduszy', 'method' => 'value', 'value' => '1'),
        array('selector' => '#l_funduszy', 'method' => 'change')
    ));
}

setCookies('branxe_next_stage', 'ok', 3);

$actions->renderScript();

?>