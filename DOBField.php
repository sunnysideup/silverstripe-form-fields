<?php
/**
 * CreditCard field, contains validation and formspec for creditcard fields.
 * @package forms
 * @subpackage fields-formattedinput
 */
class DOBField extends CalendarDateField {

	protected $minimumAgeInYears = 5;

	protected $maximumAgeInYears  = 150;

	protected static $date_not_valid_error = "Please enter a valid date of birth (DD-MM-YYYY, e.g. 01-10-1921).";
		static function set_date_not_valid_error ($v) {self::$date_not_valid_error  = $v;}

	protected static $too_young_error = "Sorry, you are too young.";
		static function set_too_young_error ($v) {self::$too_young_error  = $v;}

	protected static $too_old_error = "Sorry, you are too old";
		static function set_too_old_error ($v) {self::$too_old_error  = $v;}

	function setValue( $value ) {
		if( is_array( $value ) && $value['Day'] && $value['Month'] && $value['Year'] )
			$this->value = $value['Year'] . '-' . $value['Month'] . '-' . $value['Day'];
		else if(is_array($value)&&(!$value['Day']||!$value['Month']||!$value['Year']))
 			$this->value = null;
 		else if(is_string($value))
			$this->value = $value;
	}

	function Field() {
		$val = $this->attrValue();
		if( preg_match( '/^\d{2}\/\d{2}\/\d{4}$/', $val ) ) {
			$dateArray = explode( '/', $val );
			$val = $dateArray[2] . '-' . $dateArray[1] . '-' . $dateArray[0];
		}
		$day = $month = $year = null;
		if($val) {
			$dateArray = explode( '-', $val );
			$day = $dateArray[2];
			$month = $dateArray[1];
			$year = $dateArray[0];
		}
		$id = $this->name;
		$fieldName = $this->name;
		$tabIndex0 = $this->getTabIndexHTML(0);
		$tabIndex1 = $this->getTabIndexHTML(1);
		$tabIndex2 = $this->getTabIndexHTML(2);

		Requirements::javascript("formextensions/javascript/DOBField.js");
		return <<<HTML
			<div class="dobfield">
				<span class="littleDOBLabel">day: </span><input type="text" id="$id-day" class="day numeric" name="{$fieldName}[Day]" value="$day" maxlength="2"$tabIndex0 />
				<span class="littleDOBLabel"> month: </span><input type="text" id="$id-month" class="month numeric" name="{$fieldName}[Month]" value="$month" maxlength="2"$tabIndex1 />
				<span class="littleDOBLabel"> year: </span><input type="text" id="$id-year" class="year numeric" name="{$fieldName}[Year]" value="$year" maxlength="4"$tabIndex2 />
			</div>
HTML;
	}

	function validate($validator){
		$errorDescription = '';
		$userDate = strtotime($this->value);
 		if(!empty ($this->value) && (!preg_match('/^[0-90-9]{2,4}\-[0-9]{1,2}\-[0-90-9]{1,2}$/', $this->value) || !$userDate ) ) {
 			$errorDescription = self::$date_not_valid_error;
 		}
		else {
			if($this->minimumAgeInYears) {
				$minimumDate = strtotime("-".$this->minimumAgeInYears." Years");
				if($minimumDate < $userDate) {
					$errorDescription = self::$too_young_error;
				}
			}
			if($this->maximumAgeInYears) {
				$maximumDate = strtotime("-".$this->maximumAgeInYears." Years");
				if($maximumDate > $userDate) {
					$errorDescription = self::$too_old_error;
				}
			}

		}
		if($errorDescription) {
 			$validator->validationError(
 				$this->name,
 				$errorDescription,
 				"validation",
 				false
 			);
 			return false;
		}
 		return true;
 	}

	function setMinimumAge($v) {
		$this->minimumAgeInYears = $v;
	}

	function setMaximumAge($v) {
		$this->maximumAgeInYears = $v;
	}


}


