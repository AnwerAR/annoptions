<?php
/**
 * Filters
 *
 * @package annOptions
 * @since 1.0.0
 */

// add_filter( 'ao_panel_obj_default_fields', function( $defaults ) {
// 	$defaults['some-key'] = 'someuser';
// 	return $defaults;
// });
//
add_filter( 'ao_panel_obj_required_fields', function( $req ) {
   //$req[] = 'ID';
   $req[] = 'htmlID';

   return $req;
});

// add_filter( 'ao_validate_obj_panel', function( $data, $input_type ) {
//    //return $data;
//    switch ( $input_type ) {
//    	case 'ID':
//    		return ao_add_error( 'test_Error', 'Test error thrown on ID.' );
//    	break;
//    	default:
//    		return $data;
//    	break;
//    }
// }, 10, 3 );
