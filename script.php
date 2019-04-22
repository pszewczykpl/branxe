<?php  

class Insert {

	public function value($data) {
		foreach ($data as $value) {
			if($value["type"]=="id") {
				echo 'document.getElementById("' . $value["id"] . '").value = "' . $value["value"] . '";';
			}
			else if($value["type"]=="name") {
				echo 'document.getElementById("' . $value["id"] . '").value = "' . $value["value"] . '";';
			}
		}
	}
}

$byID = new Insert();

$byID->value(array(
	array(
		"id" => "test",
		"value" => "COŚ",
		"type" => "id"
	),
	array(
		"id" => "test2",
		"value" => "COŚ2",
		"type" => "id"
	)
));

?>