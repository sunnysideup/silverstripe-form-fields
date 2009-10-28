<?php

class DropdownOtherField extends DropdownField {
	
	static $field = 'DropdownField';
	
	static $dropdownIndex = 'Value';
	static $textareaIndex = 'Other';
	
	protected $dropdownName;
	protected $textareaName;
	
	protected $other;
	
	function __construct($name, $title, $source, $value, $other, $otherFieldText) {
		$source[self::$textareaIndex] = $otherFieldText ? $otherFieldText : 'Other (Please Enter Below)';
		if(! $value && $other != null) $value = self::$textareaIndex;
		parent::__construct($name, $title, $source, $value);
		$this->dropdownName = $this->name . '[' . self::$dropdownIndex . ']';
		$this->textareaName = $this->name . '[' . self::$textareaIndex . ']';
		$this->other = $other;
		Requirements::javascript('survey/javascript/jquery/jquery-1.3.2.js');
		Requirements::javascript('survey/javascript/otherfield.js');
	}
	
	function Field() {
		$field = $this->stat('field');
		$dropdown = new $field($this->dropdownName, $this->title, $this->source, $this->value);
		$dropdownField = $dropdown->Field();
		$textarea = new TextareaField($this->textareaName, null, 5, 20, $this->other);
		$textareaField = $textarea->Field();
		return $dropdownField . $textareaField;
	}
	
	function setValue($val) {
		if(is_array($val)) { // Comes From The Form
			$this->value = $val[self::$dropdownIndex] == self::$textareaIndex ? null : $val[self::$dropdownIndex];
			$this->other = $val[self::$dropdownIndex] == self::$textareaIndex ? $val[self::$textareaIndex] : null;
		}
		else $this->value = $val;
		return $this;
	}
	
	function saveInto(SurveyAnswer $answer) {
		$answer->setCastedField('Answer', $this->dataValue());
		$answer->setCastedField('Other', $this->other);
	}
}

?>