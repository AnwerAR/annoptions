jQuery = require('jquery');
require('./lib/jquery.repeater.js');

import select2 from './components/select2';
import repeater from './components/repeater';
import ajax from './components/ajax-save';

//some
jQuery(document).ready( function() {
   select2();
   repeater();
   ajax();
});
