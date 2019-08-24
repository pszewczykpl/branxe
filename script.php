<?php
/*  
 *  Branxe @2019
 *  by Piotr Szewczyk
 *  
 *  Branxe kfskdjf 
 */

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

?>