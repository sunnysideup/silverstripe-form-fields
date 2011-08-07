<?php

/*
 *@author Romain[at]sunnysidep.co.nz
 *
 **/


class RatingField extends OptionsetField {

	function __construct($name, $title = "", $source = array(), $value = "", $form = null) {
		parent::__construct($name, $title, $source, $value, $form);
		Requirements::javascript(THIRDPARTY_DIR."/jquery/jquery.js");
		Requirements::javascript('formfieldsextra/javascript/jquery/ui.core.js');
		Requirements::javascript('formfieldsextra/javascript/jquery/ui.slider.js');
		Requirements::javascript('formfieldsextra/javascript/ratingfield.js');
		Requirements::css('formfieldsextra/css/ui.core.css');
		Requirements::css('formfieldsextra/css/ui.slider.css');
		Requirements::css('formfieldsextra/css/ui.theme.css');
	}

}

?>
