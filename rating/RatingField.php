<?php

/*
 *@author Romain[at]sunnysidep.co.nz
 *
 **/


class RatingField extends OptionsetField {


	protected static $source_file_location = "mysite/thirdparty/formfields/rating/";
		public static function get_source_file_location() {return self::$source_file_location;}
		public static function get_source_file_location($s) {self::$source_file_location = $s;}

	function __construct($name, $title = "", $source = array(), $value = "", $form = null) {
		parent::__construct($name, $title, $source, $value, $form);
		Requirements::javascript(THIRDPARTY_DIR."/jquery/jquery.js");
		Requirements::javascript(self::get_source_file_location().'ui.core.js');
		Requirements::javascript(self::get_source_file_location().'ui.slider.js');
		Requirements::javascript(self::get_source_file_location().'ratingfield.js');
		Requirements::css(self::get_source_file_location().'ui.core.css');
		Requirements::css(self::get_source_file_location().'ui.slider.css');
		Requirements::css(self::get_source_file_location().'ui.theme.css');
	}

}


