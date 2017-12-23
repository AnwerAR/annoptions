jQuery = require('jquery');
require('select2');
const select2 = jQuery(document).ready( function() {
    jQuery(".ao-select").select2();
    jQuery(".ao-multiselect").select2();

    function ao_select2() {
      jQuery(".ao-repeator-select").select2();
      jQuery(".ao-repeator-multiselect").select2();
    }

});


export default select2;
