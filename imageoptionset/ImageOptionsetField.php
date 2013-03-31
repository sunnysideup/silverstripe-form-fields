<?php

class ImageOptionsetField extends OptionsetField {

	protected static $number_per_row = 1;
		static function set_number_per_row($v) { self::$number_per_row = $v;}
		static function get_number_per_row() { return self::$number_per_row;}

	protected $objects = null;

	protected $imageFieldName = null;

	protected $width = null;

	protected $height = null;

	function __construct($name, $title = '', $value = '', $objects, $imageFieldName = "Image", $width = 32, $height = 16) {
		$array = array();
		if($objects) {
			$array = $objects->toDropDownMap();
			$this->objects = $objects;
		}
		$this->imageFieldName = $imageFieldName;
		$this->width = $width;
		$this->height = $height;
		parent::__construct($name, $title, $array, $value);
	}

	function Field() {
		$options = '';
		$source = $this->getSource();
		$count = 0;
		if($this->objects) {
			foreach($this->objects as $obj) {
				$key = $obj->ID;
				$itemID = $this->id() . "_" . $key;
				$value = $source[$key];
				$labelHTML = $value;
				$field = $this->imageFieldName."ID";
				$method = $this->imageFieldName;
				if($obj->$field && $obj->$method()->exists()) {
					$image = $obj->$method();
					$resizedImageObject = $image->getFormattedImage("CroppedImage", $this->width,$this->height);
					if($resizedImageObject) {
						$labelHTML = '<img src="'.$resizedImageObject->URL().'" alt="'.$value.'" />';
					}
				}
				if($key == $this->value/* || $useValue */) {
					$useValue = false;
					$checked = " checked=\"checked\"";
				}
				else {
					$checked="";
				}
				$odd = ($count + 1) % 2;
				$extraClass = $odd ? "odd" : "even";
				$firstInRow = "";
				$lastInRow = "";
				$position = " pos".$count;
				if(self::$number_per_row > 1) {
					if(!(($count) % self::$number_per_row)) {$firstInRow = " firstInRow";}
					if(!(($count + 1) % self::$number_per_row)) {$lastInRow = " lastInRow";}
				}

				$extraClass .= " val" . preg_replace('/[^a-zA-Z0-9\-\_]/','_', $key);
				$disabled = $this->disabled ? 'disabled="disabled"' : '';
				$options .= "<li class=\"".$extraClass.$firstInRow.$lastInRow.$position."\"><input id=\"$itemID\" name=\"$this->name\" type=\"radio\" value=\"$key\"$checked $disabled class=\"radio\" /> <label for=\"$itemID\">$labelHTML</label></li>\n";
				$count++;
			}
			$id = $this->id();
		}
		return "<ul id=\"$id\" class=\"optionset {$this->extraClass()}\">\n$options</ul>\n";
	}

}
