<?php
/**
 * Helper methods for "AO".
 *
 * @package annOptions
 * @version 1.0.0
 * @author Anwer Abdul Rehman
 * @link http://annframe.com/annOptions
 * @since 1.0.0
 **/
class ao_initialize {

	public static $mode;
	public function __construct() {

	}

	// Mode.
	public static function mode() {
		$allowed = array( '_PLUGIN_', '_THEME_', '_CTHEME_' );
		$mode    = AO_MODE;
		if ( ! in_array( AO_MODE, $allowed ) ) {
			$mode = '_PLUGIN_';
		}
		return $mode;
	}

	// Locations
	public static function paths() {

		$locations = new stdClass();
		switch ( self::mode() ) {
			case '_PLUGIN_':
				$locations->dir = trailingslashit( plugin_dir_path( __FILE__ ) );
				$locations->uri = plugin_dir_url( __FILE__ );
				break;
			case '_THEME_':
				$path = @explode( get_template(), str_replace( '\\', '/', dirname( __FILE__ ) ) );
				$path = ltrim( end( $path ), '/' );

				$locations->dir = get_temx31plate_directory() . trailingslashit( '/' . $path );
				$locations->uri = get_template_directory_uri() . trailingslashit( '/' . $path );
				break;
			case '_CTHEME_':
				$path           = @explode( get_stylesheet(), str_replace( '\\', '/', dirname( __FILE__ ) ) );
				$path           = ltrim( end( $path ), '/' );
				$locations->dir = get_stylesheet_directory() . trailingslashit( '/' . $path );
				$locations->uri = get_stylesheet_directory_uri() . trailingslashit( '/' . $path );
				break;
			default:
				$locations->dir = trailingslashit( plugin_dir_path( __FILE__ ) );
				$locations->uri = plugin_dir_url( __FILE__ );
				break;
		}

		$locations->dir = str_replace( 'classes/', '', $locations->dir );
		$locations->uri = str_replace( 'classes/', '', $locations->uri );

		return $locations;
	}


} // END of helper class.
