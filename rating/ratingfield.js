jQuery(document).ready(
	function() {
		jQuery('div.rating').each(
			function() {
				var name = this.id;
				
				var optionList = jQuery(this).find('ul');
				
				var optionValues = jQuery(optionList).find('li');
				var optionValuesArray = jQuery.makeArray(optionValues);
				
				var sliderValueCheckedIndex = null;
				
				var sliderValues = jQuery.map(
					optionValuesArray,
					function(value, index) {
						var input = jQuery(value).find('input');
						if(jQuery(input).attr('checked')) sliderValueCheckedIndex = index;
						return jQuery(input).attr('value');
					}
				);
				var sliderTitles = jQuery.map(
					optionValuesArray,
					function(value, index) {
						return jQuery(value).find('label').text();
					}
				);
				
				if(! sliderValueCheckedIndex) sliderValueCheckedIndex = 0;
				
				var sliderContainer = jQuery(this).find('.middleColumn');
				
				jQuery(sliderContainer).empty();
				jQuery(sliderContainer).append('<input name="' + name + '" type="hidden" value="' + sliderValues[sliderValueCheckedIndex] + '"/>');
				jQuery(sliderContainer).append('<p id="' + name + '_Title">' + sliderTitles[sliderValueCheckedIndex] + '</p>');
				jQuery(sliderContainer).append('<div class="slider"/>');
				jQuery(sliderContainer).find('.slider').slider(
					{
						max : sliderValues.length - 1,
						step : 1,
						value : sliderValueCheckedIndex,
						slide : function(event, ui) {
							jQuery('#' + name + ' input[name=' + name + ']').val(sliderValues[ui.value]);
							jQuery('#' + name + '_Title').text(sliderTitles[ui.value]);
						}
					}
				);
			}
		);
	}
);