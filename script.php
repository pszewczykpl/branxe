<?php  

class Actions {

	public function insertValue($data) {
		foreach ($data as $value) {
			if($value["type"]=="id") {
				echo 'document.getElementById("' . $value["id"] . '").value = "' . $value["value"] . '";';
			}
			else if($value["type"]=="name") {
				echo 'document.getElementByName("' . $value["name"] . '").value = "' . $value["value"] . '";';
			}
		}
	}

	public function click($data) {
		foreach ($data as $value) {
			if($value["type"]=="id") {
				echo 'document.getElementById("' . $value["id"] . '").click();';
			}
			else if($value["type"]=="name") {
				echo 'document.getElementByName("' . $value["name"] . '").click();';
			}
		}
	}

	public function check($data) {
		foreach ($data as $value) {
			if($value["type"]=="id") {
				echo 'document.getElementById("' . $value["id"] . '").checked = ' . $value['value'] . ';';
			}
			else if($value["type"]=="name") {
				echo 'document.getElementByName("' . $value["name"] . '").checked = ' . $value['value'] . ';';
			}
		}
	}
}

$actions = new Actions();

$actions->insertValue(
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

$actions->click(
	array(
		array(
			"type" => "id",
			"id" => "test3",
			"change" => true
		)
	)
);

$actions->check(
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