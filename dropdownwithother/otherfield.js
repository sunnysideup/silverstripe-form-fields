jQuery(document).ready(
	function() {
		jQuery('div.dropdownother').each(
			function() {
				var name = this.id;
				
				var dropdownId = name + '-Value';
				var textareaId = name + '-Other';
				
				var dropdown = jQuery('#' + dropdownId);
				var textarea = jQuery('#' + textareaId);
				
				if(jQuery(dropdown).val() != 'Other') jQuery(textarea).hide();
				
				jQuery(dropdown).change(
					function() {
						if(jQuery(this).val() == 'Other') jQuery(textarea).show();
						else jQuery(textarea).hide();
					}
				);
			}
		);
		
		jQuery('div.optionsetother').each(
			function() {
				var name = this.id;
				
				var optionName = name + '[Value]';
				var textareaId = name + '-Other';
				
				var optionset = jQuery('input[name=' + optionName + ']');
				var optionselected = jQuery('input[name=' + optionName + '][checked]');
				var textarea = jQuery('#' + textareaId);
				
				if(optionselected != null && jQuery(optionselected).val() != 'Other') jQuery(textarea).hide();
				
				jQuery(optionset).change(
					function() {
						if(jQuery(this).val() == 'Other') jQuery(textarea).show();
						else jQuery(textarea).hide();
					}
				);
			}
		);
	}
);