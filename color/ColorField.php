<?php

class ColorField extends TextField {

	protected static $source_file_location = "mysite/thirdparty/formfields/color/";
		public static function get_source_file_location() {return self::$source_file_location;}
		public static function set_source_file_location($s) {self::$source_file_location = $s;}

	function __construct($name, $title = null, $value = '#000000') {
		parent::__construct($name, $title, $value);
		Requirements::javascript(THIRDPARTY_DIR."/jquery/jquery.js");
		Requirements::javascript(self::get_source_file_location().'farbtastic.js');
		Requirements::javascript(self::get_source_file_location().'colorfield.js');
		Requirements::css(self::get_source_file_location().'ColorField.css');
		Requirements::css(self::get_source_file_location().'farbtastic.css');//echo $this->value;
	}

	function Field() {
		$field = parent::Field();
		$field .= '<img src="'.self::get_source_file_location().'color-icon.png" class="coloricon"/><div class="colorpopup"></div>';
		return $field;
	}
}

class ColorField_ReadOnly extends ReadonlyField {

	function Field() {
		if($this->value) $value = $this->dontEscape ? ($this->reserveNL ? Convert::raw2xml($this->value) : $this->value) : Convert::raw2xml($this->value);
		else $value = '<i>(' . _t('FormField.NONE', 'none') . ')</i>';

		$attributes = array(
			'id' => $this->id(),
			'class' => 'readonly' . ($this->extraClass() ? $this->extraClass() : '')
		);
		if($this->value) $attributes['style'] = "background-color: $this->value";

		$hiddenAttributes = array(
			'type' => 'hidden',
			'name' => $this->name,
			'value' => $this->value,
			'tabindex' => $this->getTabIndex()
		);

		$containerSpan = $this->createTag('span', $attributes, $value);
		$hiddenInput = $this->createTag('input', $hiddenAttributes);

		return $containerSpan . "\n" . $hiddenInput;
	}

}

?>
