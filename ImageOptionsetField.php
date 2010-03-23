<?php

class ImageOptionsetField extends OptionsetField {

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
		$odd = 0;
		$source = $this->getSource();
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
				} else {
					$checked="";
				}

				$odd = ($odd + 1) % 2;
				$extraClass = $odd ? "odd" : "even";
				$extraClass .= " val" . preg_replace('/[^a-zA-Z0-9\-\_]/','_', $key);
				$disabled = $this->disabled ? 'disabled="disabled"' : '';

				$options .= "<li class=\"".$extraClass."\"><input id=\"$itemID\" name=\"$this->name\" type=\"radio\" value=\"$key\"$checked $disabled class=\"radio\" /> <label for=\"$itemID\">$labelHTML</label></li>\n";
			}
			$id = $this->id();
		}
		return "<ul id=\"$id\" class=\"optionset {$this->extraClass()}\">\n$options</ul>\n";
	}

}

?>