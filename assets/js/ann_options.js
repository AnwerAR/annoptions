jQuery(document).ready( function() {
  if ( jQuery( '.ao-select' ).not(".ao-repeator-field")) {

    jQuery(".ao-select").select2();
    jQuery(".ao-multiselect").select2();
    }
});
function ao_select2() {
  jQuery(".ao-repeator-select").select2();
  jQuery(".ao-repeator-multiselect").select2();
}
jQuery(document).ready( function() {

           jQuery('form.aoptions-form').submit( function ( e ) {
             e.preventDefault();
                submit = jQuery('#submit');
                submitValue = jQuery('#submit').val();
                submit.val( 'Saving' );
                var b =  jQuery(this).serialize();
                jQuery.post( 'options.php', b ).error(
                    function() {
                        alert('error');
                    }).success( function() {
                        alert('success');
                        submit.val( submitValue );
                    });
                    return false;
                });

});


    jQuery(document).ready(function () {
        jQuery('form').repeater({
            // (Optional)
            // start with an empty list of repeaters. Set your first (and only)
            // "data-repeater-item" with style="display:none;" and pass the
            // following configuration flag
            initEmpty: true,
            // (Optional)
            // "defaultValues" sets the values of added items.  The keys of
            // defaultValues refer to the value of the input's name attribute.
            // If a default value is not specified for an input, then it will
            // have its value cleared.
            defaultValues: {
                'ao_options[ao-repeator][0][ao-admin-mail]': 'placehold@eail.com',
                'ao-manager-mail': 'placehold@manager.com',

            },
            // (Optional)
            // "show" is called just after an item is added.  The item is hidden
            // at this point.  If a show callback is not given the item will
            // have $(this).show() called on it.
            //show: function () {
                //jQuery(this).slideDown();
            //},
            show: function () {
              jQuery(this).addClass('iamadded');
              ao_select2();
              //jQuery(this).find('.chosen').chosen({ width: "100%", disable_search: true });
              jQuery(this).slideDown();
            },
            // (Optional)
            // "hide" is called when a user clicks on a data-repeater-delete
            // element.  The item is still visible.  "hide" is passed a function
            // as its first argument which will properly remove the item.
            // "hide" allows for a confirmation step, to send a delete request
            // to the server, etc.  If a hide callback is not given the item
            // will be deleted.
            hide: function (deleteElement) {
                if(confirm('Are you sure you want to delete this element?')) {
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
        })
    });
  //  $('.repeater').repeaterVal();