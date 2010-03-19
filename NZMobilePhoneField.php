<?php

/**
 * Password input field.
 * @package forms
 * @subpackage fields-formattedinput
 */
class NZMobilePhoneField extends PasswordField {


	function jsValidation() {
		$formID = $this->form->FormName();
		$jsFunc =<<<JS
Behaviour.register({
	"#$formID": {
		validateNZMobilePhoneField: function(fieldName) {
			var string = '';
			var test1 = false;
			var test2 = false;
			var error = new Array;
			var errorString = '';
			el = _CURRENT_FORM.elements[fieldName];
			string = el.value;
			string = string.replace("+64", "");
			string = string.replace("+", "");
			string = string.replace(/[^0-9]/g, ''); //remove all non-digit characters
			if(!string) {
				errorString = "Please enter a valid New Zealand mobile phone number.";
				validationError(el, errorString,"validation");
				return false;
			}
			if (string.length > 8)                    {test1 = true;} else {error[1] = "the number appears too short";}
			if (string.length < 12)                   {test1 = true;} else {error[1] = "the number appears too long";}
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
		if(strlen($string) > 7 && strlen($string) < 11) {
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
		$this->value = "+64".$this->value;
		return $this->value;
	}


	function cleanInput($v) {
		$string = str_replace("+64", "", $string);
		$string = str_replace("+", "", $string);
		$string = preg_replace('/\D/', '', $string);
		$string = intval($string);
		return $string."";
	}

}


