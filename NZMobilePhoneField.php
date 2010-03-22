<?php

/**
 * Password input field.
 * @package forms
 * @subpackage fields-formattedinput
 */
class NZMobilePhoneField extends TextField {


	function jsValidation() {
		$formID = $this->form->FormName();
		$jsFunc =<<<JS
Behaviour.register({
	"#$formID": {
		validateNZMobilePhoneField: function(fieldName) {
			var string = '';
			var test1 = false;
			var test2 = false;
			var test3 = false;
			var error = new Array;
			var errorString = '';
			el = _CURRENT_FORM.elements[fieldName];
			string = el.value;
			if(!el || !el.value) {
				return true;
			}
			string = string.replace("+64", "");
			string = string.replace("+", "");
			string = string.replace(/[^0-9]/g, ''); //remove all non-digit characters
			if(!string) {
				errorString = "Please enter a valid New Zealand mobile phone number.";
				validationError(el, errorString,"validation");
				return false;
			}
			if (string.length > 8)                    {test1 = true;} else {error[1] = "the number appears too short";}
			if (string.length < 12)                   {test2 = true;} else {error[2] = "the number appears too long";}
			if (string[0] + string[1] == "02")        {test3 = true;} else {error[3] = "your number should start with 02";}
			if(test1 && test2) {
				return true;
			}
			else {
				for(var i = 0; i < error.length; i++) {
					if(errorString.length > 0 && error[i]) {
						errorString += ", and ";
					}
					if(error[i]) {
						errorString += error[i];
					}
				}
				errorString = "There was an error with your New Zealand mobile phone number - it should be entered as follows: 021123456: " + errorString + ".";
				validationError(el, errorString,"validation");
				return false;
			}
		}
	}
});
JS;

		Requirements::customScript($jsFunc, 'func_validateNZMobilePhoneField');

		return <<<JS
if(typeof fromAnOnBlur != 'undefined'){
	if(fromAnOnBlur.name == '$this->name')
		$('$formID').validateNZMobilePhoneField('$this->name');
}else{
	$('$formID').validateNZMobilePhoneField('$this->name');
}
JS;
	}

	/** PHP Validation **/
	function validate($validator){
		$ok = false;
		$string = $this->cleanInput($this->value);
		if(!trim($string)) {
			return true;
		}
		$length = strlen($string);
		$firstCharacter = substr($string, 0, 1);
		if($length > 7 && $length < 11 &&  $firstCharacter == "2") {
			$ok = true;
		}
		if($ok) {
			return true;
		}
		else {
 			$validator->validationError(
 				$this->name,
				"There is a problem with your New Zealand phone number - it should have a format like this 021123456.",
				"validation"
			);
			return false;
		}
	}

	function dataValue() {
		$string = $this->cleanInput($this->value);
		//$this->value = "+64".$this->value;
		return $this->value;
	}


	function cleanInput($string) {
		$string = str_replace("+64", "", $string);
		$string = preg_replace('/\D/', '', $string);
		$string = intval($string);
		return $string."";
	}

}


