jQuery(document).ready(
	function() {
		jQuery('div.field.color div.colorpopup').each(
			function() {
				var inputField = jQuery(this).prevAll('input');
				if(! jQuery(inputField).val()) jQuery(inputField).val('#000000');
				jQuery(this).farbtastic(inputField);
			}
		);
		jQuery('div.field.color img.coloricon').click(
			function() {
				var colorPopup = jQuery(this).next('div.colorpopup');
				if(jQuery(colorPopup).is(':visible')) jQuery(colorPopup).hide();
				else {
					jQuery('div.field.color div.colorpopup').hide();
					jQuery(colorPopup).show();
				}
			}
		);
	}
);