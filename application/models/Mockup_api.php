<?php

class Mockup_api extends CI_Model {

	public function getTeachers()
	{
		$file = file_get_contents('api.json');
		$api = json_decode($file, true);

		return $api['result'];
    }
}
?>