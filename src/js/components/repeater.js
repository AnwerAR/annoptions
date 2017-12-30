jQuery = require('jquery');
require('../lib/jquery.repeater.js');
require('select2');

function ao_select2() {
	jQuery(".ao-repeater-select").select2();
	jQuery(".ao-repeater-multiselect").select2();
}

const repeater = jQuery('.ao-repeater-wrapper').repeater({
	// (Optional)
	// start with an empty list of repeaters. Set your first (and only)
	// "data-repeater-item" with style="display:none;" and pass the
	// following configuration flag
	initEmpty: false,
	defaultValues: {},
	// (Optional)
	// "show" is called just after an item is added.  The item is hidden
	// at this point.  If a show callback is not given the item will
	// have $(this).show() called on it.
	//show: function () {
	//jQuery(this).slideDown();
	//},
	show: function() {
		ao_select2();
		//jQuery(this).find('.chosen').chosen({ width: "100%", disable_search: true });
		jQuery(this).slideDown();
	},
	ready: function() {
		ao_select2();
	},
	// (Optional)
	// "hide" is called when a user clicks on a data-repeater-delete
	// element.  The item is still visible.  "hide" is passed a function
	// as its first argument which will properly remove the item.
	// "hide" allows for a confirmation step, to send a delete request
	// to the server, etc.  If a hide callback is not given the item
	// will be deleted.
	hide: function(deleteElement) {
		if (confirm('Are you sure you want to delete this element?')) {
			jQuery(this).slideUp(deleteElement);
		}
	},
	// (Optional)
	// You can use this if you need to manually re-index the list
	// for example if you are using a drag and drop library to reorder
	// list items.
	//ready: function (setIndexes) {
	//dragAndDrop.on('drop', setIndexes);
	//},
	// (Optional)
	// Removes the delete button from the first list item,
	// defaults to false.
	isFirstItemUndeletable: true
});
//  $('.repeater').repeaterVal();

export default repeater;
