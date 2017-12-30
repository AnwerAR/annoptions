jQuery = require('jquery');
require('jquery.repeater');
require('select2');

function ao_select2() {
	jQuery(".ao-repeater-select").select2();
	jQuery(".ao-repeater-multiselect").select2();
}

const repeater = jQuery('.ao-repeater-wrapper').repeater({

	initEmpty: false,
	defaultValues: {},
	show: function() {
		ao_select2();
		jQuery(this).slideDown();
	},
	ready: function() {
		ao_select2();
	},
	hide: function(deleteElement) {
		if (confirm('Are you sure you want to delete this element?')) {
			jQuery(this).slideUp(deleteElement);
		}
	},
	isFirstItemUndeletable: true
});

export default repeater;
