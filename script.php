<?php

/*  
 *	Branxe @2019
 *  by Piotr Szewczyk
 *	
 *	Branxe kfskdjf 
 */

class Actions {

	public function insertValue($data) {

		$script = "";

		foreach ($data as $value) {
			if($value["type"]=="id") {
				$script .= 'document.getElementById("' . $value["id"] . '").value = "' . $value["value"] . '";';
			}
			else if($value["type"]=="name") {
				$script .= 'document.getElementByName("' . $value["name"] . '").value = "' . $value["value"] . '";';
			}
		}

		return $script;
	}

	public function click($data) {

		$script = "";

		foreach ($data as $value) {
			if($value["type"]=="id") {
				$script .= 'document.getElementById("' . $value["id"] . '").click();';
			}
			else if($value["type"]=="name") {
				$script .= 'document.getElementByName("' . $value["name"] . '").click();';
			}
		}

		return $script;
	}

	public function check($data) {

		$script = "";

		foreach ($data as $value) {
			if($value["type"]=="id") {
				$script .= 'document.getElementById("' . $value["id"] . '").checked = ' . $value['value'] . ';';
			}
			else if($value["type"]=="name") {
				$script .= 'document.getElementByName("' . $value["name"] . '").checked = ' . $value['value'] . ';';
			}
		}

		return $script;
	}
}

$actions = new Actions();

echo $actions->insertValue(
	array(
		array(
			"type" => "id",
			"id" => "test",
			"value" => "COŚ",
			"change" => true
		),
		array(
			"type" => "id",
			"id" => "test2",
			"value" => "COŚ2",
			"change" => true
		)
	)
);

echo $actions->click(
	array(
		array(
			"type" => "id",
			"id" => "test3",
			"change" => true
		)
	)
);

echo $actions->check(
	array(
		array(
			"type" => "id",
			"id" => "test4",
			"value" => "true",
			"change" => true
		)
	)
);

?>