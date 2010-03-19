<?php

/**
 * Password input field.
 * @package forms
 * @subpackage fields-formattedinput
 */
class NZGovtPasswordValidatorPasswordField extends PasswordField {


	function jsValidation() {
		$formID = $this->form->FormName();
		$jsFunc =<<<JS
Behaviour.register({
	"#$formID": {
		validateNZGovtPasswordValidatorPasswordField: function(fieldName) {
			var string = '';
			var test1 = false;
			var test2 = false;
			var test3 = false;
			var test4 = false;
			var test5 = false;
			var error = new Array;
			var errorString = '';
			el = _CURRENT_FORM.elements[fieldName];
			string = el.value;
			if(!string) {
				errorString = "Please enter a Password.";
				validationError(el, errorString,"validation");
				return false;
			}
			if (string.length > 6)                    {test1 = true;} else {error[1] = "it should have at least seven characters";}
			if (string.match(/[a-z]/))                {test2 = true;} else {error[2] = "it should have at least one lowercase letter (e.g. h, j, or u)";}
			if (string.match(/[A-Z]/))                {test3 = true;} else {error[3] = "it should have at least one uppercase letter (e.g. H, J or U)";}
			if (string.match(/\d+/))                  {test4 = true;} else {error[4] = "it should have at least one digit (e.g. 1, 2, 3 or 4)";}
			if (p.match(/.[!,@,#,$,%,^,&,*,?,_,~]/))  {test5 = true;} else {error[5] = "it should have at least one punctuation character (e.g. ~, @, #, or $)";}
			if(test1 && test2 && test3 && test4 && test5) {
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
				errorString = "There was an error with your Password, please not its requirements: " + errorString + ".";
				validationError(el, errorString,"validation");
				return false;
			}
		}
	}
});
JS;

		Requirements::customScript($jsFunc, 'func_validateNZGovtPasswordValidatorPasswordField');

		return <<<JS
if(typeof fromAnOnBlur != 'undefined'){
	if(fromAnOnBlur.name == '$this->name')
		$('$formID').validateNZGovtPasswordValidatorPasswordField('$this->name');
}else{
	$('$formID').validateNZGovtPasswordValidatorPasswordField('$this->name');
}
JS;
	}

	/** PHP Validation **/
	function validate($validator){
		$string = $this->cleanInput($this->value);
		$validator = new NZGovtPasswordValidator();
		$member = Member::currentMember();
		if(!$member){
			$member = new Member();
			$member->ID = 0;
		}
		$outcome = $validator->validate($string, $member);
		if($outcome->valid()) {
			return true;
		}
		else {
 			$validator->validationError(
 				$this->name,
				"There is a problem with your Snapper Number: ".implode(", and ", $error).".",
				"validation"
			);
			return false;
		}
	}

}


