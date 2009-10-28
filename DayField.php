<?php

class DayField extends DropdownField {
	
	function __construct($name, $title = null, $value = '') {
		for($i = 1; $i <= 31; $i++) $days[$i] = date('jS', mktime(0, 0, 0, 1, $i, 2008));
		parent::__construct($name, $title, $days, $value);
	}
}

?>