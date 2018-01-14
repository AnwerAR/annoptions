<?php
/**
 * A set of handy helper functions.
 * RULES: function name must be starting with 'ao_' prefix.
 *
 * @package annOptions
 * @since 1.0.0
 */

/**
 * Check array key.
 *
 * @since 1.0.0
 *
 * @param string $slug to search.
 * @param array  $args where search performs.
 * @return bool    true | false.
 */
function ao_is_not_array_key( $slug, $args ) {

	if ( ! array_key_exists( $slug, $args ) ) {
		return false;
	}
	return true;
}

/**
 * Check array key.
 *
 * @since 1.0.0
 *
 * @param string $input check value.
 * @return bool   true | false.
 */
function ao_is_null( $input ) {
	if ( $input == '' || $input == null || $input == false ) {
		return false;
	}

	return true;
}

/**
 * Check array key.
 *
 * @since 1.0.0
 *
 * @param string $path of file under annOptions.
 * @param string $file_name widhout .php extension.
 * @return bool      true | false
 */
function ao_template_exists( $path, $file_name ) {
	if ( file_exists( AO_DIR . $path . '/' . $file_name . '.php' ) ) {
		return true;
	}
	return false;
}

/**
 * Check array key.
 *
 * @since 1.0.0
 *
 * @param string $path of file under annOptions.
 * @param string $file name widhout .php extension.
 * @param array  $args to pass to template file.
 * @param bool   $return or print. Default print
 * @return mixed      $data | null temolate file or bail out silently.
 */
function ao_get_template_part( $path, $file_name, $args = array(), $return = false ) {
	$args = wp_parse_args( $args );
	if ( file_exists( AO_DIR . $path . '/' . $file_name . '.php' ) ) {
		$file = AO_DIR . $path . '/' . $file_name . '.php';
		ob_start();
		$file = require_once $file;
		$data = ob_get_clean();
		if ( $return === true ) {
			if ( $file == false ) {
				return false;
			}
			return $data;
		}
		echo $data;
	} else {
		// Bail silently.
	}
}

/**
 * Generate unique id (md5) of supplied string.
 *
 * @since 1.0.0
 *
 * @param string      $string.
 * @param string|null $prefix.
 * @param string|null $suffix.
 * @return string     md5 of input string with optional prefix and suffix.
 */
function ao_html_unqid( $string, $prefix = '', $suffix = '' ) {
	$suffix = ( '' == $suffix ) ? '' : '-' . $suffix;
	$prefix = ( '' == $prefix ) ? '' : $prefix . '-';
	return $prefix . substr( md5( $string ), 0, 12 ). $suffix;
}
