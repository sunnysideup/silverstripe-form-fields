<?php

class MonthField extends DropdownField {
		
	function __construct($name, $title = null, $value = '') {
		for($i = 1; $i <= 12; $i++) $months[$i] = $i;
		parent::__construct($name, $title, $months, $value);
	}
}

?>