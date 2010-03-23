<?php

class NZCityField extends DropdownField {


	function __construct($name, $title = null) {
		parent::__construct($name, $title = null, $this->cityList(), $value = "", $form = null, $emptyString = "Select a city");
	}

	protected function cityList() {
		$array = array(
			"Auckland" => "Auckland",
			"Christchurch" => "Christchurch",
			"Wellington" => "Wellington",
			"Hamilton" => "Hamilton",
			"Tauranga" => "Tauranga",
			"Dunedin" => "Dunedin",
			"Palmerston North" => "PalmerstonNorth",
			"Hastings" => "Hastings",
			"Nelson" => "Nelson",
			"Napier" => "Napier",
			"Rotorua" => "Rotorua",
			"New Plymouth" => "New Plymouth",
			"Whangarei" => "Whangarei",
			"Invercargill" => "Invercargill",
			"Whanganui" => "Whanganui",
			"Gisborne" => "Gisborne"
		);
		ksort($array);
		return $array;
	}


}


class CityField_Data extends DataObject {



}
