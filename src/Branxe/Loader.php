<?php
/*  
 *  Branxe @2019
 *  by Piotr Szewczyk
 * 
 */

class Identity {

	/*
     * Generate birthday date and set $this->_birthdayDate;
     * 
     * @since    0.0.1
     */
    public function generateBirthdayDate() {

        return $this->randomDate();
    }

    /*
     * Generate sex and set $this->_sex;
     * 
     * @since    0.0.1
     */
    public function generateSex() {

        switch($this->randomNumber()) {
            case 0:
                return 'M';
                break;
            case 1:
                return 'K';
                break;
        }
    }

    /*
     * Generate ID card number and set $this->_idCardNumber;
     * 
     * @since    0.0.1
     */
    public function generateIdCardNumber() {

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
     * Generate passport card number and set $this->_passportCardNumber;
     * 
     * @since    0.0.1
     */
    public function generatePassportCardNumber() {

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
     * Generate pesel and set $this->_pesel;
     * 
     * @since    0.0.1
     */
    public function generatePesel() {

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
    public function randomDate($start = '1960-01-01', $end = '1996-01-01', $format = 'Y-m-d') {

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
    public function randomChar($length = 1) {

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
    public function lengthArray($data) {

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

$test = new Identity();
echo $test->generateBirthdayDate();
echo $test->generateSex();

?>