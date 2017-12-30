jQuery = require('jquery');

const ajax = jQuery('form.aoptions-form').submit(function(e) {

	e.preventDefault();
	submit = jQuery('#submit');
	submitValue = jQuery('#submit').val();
	submit.val('Saving');
	var b = jQuery(this).serialize();
	jQuery.post('options.php', b).error(
		function() {
			alert('error');
		}).success(function() {
		alert('success');
		submit.val(submitValue);
	});
	return false;
});

export default ajax;
