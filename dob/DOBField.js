;(function(jQuery) {
	jQuery(document).ready(
		function() {
			DOBField.dobStepThrough();
		}
	);
	var DOBField = {

		dobInputSelector: ".dobfield input",

		nextFieldSelector: "",

		activeFieldClass: "activeDOBItem",

		set_nextFieldSelector: function(v) {
			this.nextFieldSelector = v;
		},

		dobStepThrough: function() {
			jQuery(DOBField.dobInputSelector).each(
				function() {
					jQuery(this).keyup(
						function () {
							var next = '';
							var name = '';
							var maxLength = jQuery(this).attr("maxlength")-0;
							if(jQuery(this).val().length == maxLength) {
								switch(jQuery(this).attr("name")) {
									case "DOB[Day]":
										name = "Day";
										next = "Month";
										break;
									case "DOB[Month]":
										name = "Month";
										next = "Year";
										break;
									case "DOB[Year]":
										number = "Year";
										next = "end";
										break;
									default:
										alert("error");
								}
								if(next) {
									jQuery(DOBField.dobInputSelector).removeClass(DOBField.activeFieldClass);
									if("end" == next) {
										var fields = jQuery(this).parents("fieldset").find('button,input,textarea,select');
										var index = fields.index( this );
										if ( index > -1 && ( index + 1 ) < fields.length ) {
											fields.eq( index + 1 ).focus();
										}
									}
									else {
										nextName = "DOB[" + next + "]";
										jQuery("input[name='" + nextName + "']").focus();
										jQuery(DOBField.dobInputSelector+"[name='" + nextName + "']").addClass(DOBField.activeFieldClass);

									}
								}
							}
						}
					);
				}
			);
		}
	}

	jQuery.fn.focusNextInputField = function() {
		return this.each(
			function() {
				return false;
			}
		);
	}
})(jQuery);


