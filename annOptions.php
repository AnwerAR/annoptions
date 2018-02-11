<?php
/**
 * Simple yet powerfull framework for adding custom option pages.
 *
 *   Plugin Name: annOptions
 *   Plugin URI: https://github.com/AnwerAR/annOptions
 *   Description: Simple yet powerfull framework for adding custom option pages.
 *   Version: 1.0.0
 *   Author: Anwer Abdul Rehman
 *   Author URI: http://annframe.com
 *   License: GPL2
 *
 * @package annOptions
 * @version 1.0.0
 * @author  Anwer AR
 * @link    http://annframe.com/annOptions
 **/

 /**
  * Restrict direct access.
  *
  * @package annOptions
  * @since 1.0.0
  */
defined( 'ABSPATH' ) || exit;

/**
 * By default this script works as standalone WordPress Plugin.
 * but also it can be used as a library in your theme or child theme.
 * Allowed modes are  _PLUGIN_, _THEME_ & _CTHEME_
 *
 * To use this plugin with in your theme as a Library
 * include it with in your theme or child theme folder and call annOptions.php
 * file from yout theme functions.php file.
 * and set mode to _THEME_ or _CTHEME_
 * for more info about modes see our documentation file.
 *
 * @package annOptions
 * @since   1.0.0
 */
if ( ! defined( 'AO_MODE' ) ) {
	define( 'AO_MODE', '_PLUGIN_' );
}

/**
 * Define Base file.
 *
 * @package annOptions
 * @since 1.0.0
 */
if ( ! defined( 'AO_FILE' ) ) {
	define( 'AO_FILE', __FILE__ );
}

if ( ! class_exists( 'annOptions' ) ) {

	/**
	 * Main class.
  *
  * @since 1.0.0
	 */
	final class annOptions {


		/**
		 * Single & only single instance of class.
		 *
		 * @since 1.0.0
		 * @var annOptions
		 */
		public static $_instance = null;

		/**
		 * annOptions version.
		 *
		 * @since 1.0.0
		 * @var string
		 */
		public $version = '1.0.0';

		/**
		 * Paths object.
		 *
		 * @since 1.0.0
		 * @var object
		 */
		private static $paths = false;

		/**
		 * annOptions instance
		 *
		 * Ensure only one instance can be loaded.
		 *
		 * @since 1.0.0
		 * @static
		 *
		 * @return annOptions - Main instance.
		 */
		public static function init() {

			if ( self::$_instance === null ) {
				self::$_instance = new self();
			}
			return self::$_instance;
		}

		 /**
		  * Main Constructor
		  *
		  * Place to initialize carious other methods & Hooks.
		  *
		  * @since 1.0.0
		  */
		public function __construct() {
			$this->constants();
			$this->requires();
		}

		 /**
		  * Prevent Clonning.
		  *
		  * @since 1.0.0
		  */
		public function __clone() {

			if ( wp_doing_ajax() ) {
				do_action( 'doing_it_wrong_run', __FUNCTION__, __( 'Clonning Disabled.', 'annoptions' ), '1.0.0' );
				error_log( __FUNCTION__ . ' was called incorrectly. Clonning Disabled since  1.0.0.' );
			} else {
				_doing_it_wrong( __FUNCTION__, __( 'Clonning Disabled.', 'annoptions' ), '1.0.0' );
			}
		}

		 /**
		  * Unserializing is forbidden.
		  *
		  * @since 2.1
		  */
		public function __wakeup() {

			if ( wp_doing_ajax() ) {
			    do_action( 'doing_it_wrong_run', __FUNCTION__, __( 'Clonning Disabled.', 'annoptions' ), '1.0.0' );
				error_log( __FUNCTION__ . ' was called incorrectly. Clonning Disabled since  1.0.0.' );
			} else {
				_doing_it_wrong( __FUNCTION__, __( 'Clonning Disabled.', 'annoptions' ), '1.0.0' );
			}
		}

		/**
		 * Auto load methods from external classes.
		 *
		 * @since 2.1
		 */
	   public function __get( $key ) {
		   // @todo more pre defined checks expected here.
		   if( method_exists( $this, $key ) ) {
			   return $this->$key();
		   }
	   }

	   /**
	    * Default Constants
	    *
	    * @since 1.0.0
	    */
		public function constants() {
			$this->define( 'AO_VERSION', $this->version );
			$this->define( 'AO_ABSPATH', dirname( AO_FILE ) . '/' );
			$this->define( 'AO_DIR', self::paths( 'dir' ) );
			$this->define( 'AO_URI', self::paths( 'uri' ) );
			$this->define( 'AO_INC_DIR', AO_DIR . 'includes' );
			$this->define( 'AO_INC_URI', AO_URI . 'includes' );
			$this->define( 'AO_ASSETS_DIR', AO_DIR . 'dist' );
			$this->define( 'AO_ASSETS_URI', AO_URI . 'dist' );
			$this->define( 'AO_CSS_DIR', AO_ASSETS_DIR . trailingslashit( '/css' ) );
			$this->define( 'AO_CSS_URI', AO_ASSETS_URI . trailingslashit( '/css' ) );
			$this->define( 'AO_JS_DIR', AO_ASSETS_DIR . trailingslashit( '/js' ) );
			$this->define( 'AO_JS_URI', AO_ASSETS_URI . trailingslashit( '/js' ) );
			$this->define( 'AO_FONTS_DIR', AO_ASSETS_DIR . trailingslashit( '/fonts' ) );
			$this->define( 'AO_FONTS_URI', AO_ASSETS_URI . trailingslashit( '/fonts' ) );
			$this->define( 'AO_IMG_DIR', AO_ASSETS_DIR . trailingslashit( '/images' ) );
			$this->define( 'AO_IMG_URI', AO_ASSETS_URI . trailingslashit( '/images' ) );
		}

	   /**
	    * Define constants
	    *
	    * @since 1.0.0
	    *
	    * @param string $const Constant Name
	    * @param mixed $val Constant Value
	    */
		public function define( $const, $val ) {
			if( ! defined( $const ) ) {
				define( $const, $val );
			}
		}

		/**
		 * Include all required files.
		 *
		 * @since 1.0.0
		 */
		public function requires()  {
			/**
			 * Class autoloader
			 */
			include_once AO_ABSPATH . 'classes/ao-autoloader.php';

			/**
			 * Helper functions
			 */
			require_once AO_ABSPATH . 'includes/helpers.php';
 			//require_once AO_ABSPATH . 'includes/demo.php';
			require __DIR__ . '/includes/filters.php';
		}

		/**
		 * If mode is not defined it's plu
		 *
		 * @since 1.0.0
		 *
		 * @return string  _PLUGIN_ | _THEME_ | _CTHEME_
		 */
		public static function mode() {
			return ( ! in_array( AO_MODE, array( '_PLUGIN_', '_THEME_', '_CTHEME_' ) ) ) ? '_PLUGIN_' : AO_MODE;
	 	}

		/**
		 * If mode is not defined it's plu
		 *
		 * @since 1.0.0
		 *
		 * @param string $key - Optional paramater to retrive URL or Full Directory path.
		 * @return object - Dir's and URL's
		 */
		public static function paths( $key = null ) {
			switch ( self::mode() ) {
				case '_PLUGIN_':
					self::$paths['dir'] = trailingslashit( plugin_dir_path( __FILE__ ) );
					self::$paths['uri'] = plugin_dir_url( __FILE__ );
					break;
				case '_THEME_':
					$path = @explode( get_template(), str_replace( '\\', '/', dirname( __FILE__ ) ) );
					$path = ltrim( end( $path ), '/' );
					self::$paths['dir'] = get_template_directory() . trailingslashit( '/' . $path );
					self::$paths['uri'] = get_template_directory_uri() . trailingslashit( '/' . $path );
					break;
				case '_CTHEME_':
					$path           = @explode( get_stylesheet(), str_replace( '\\', '/', dirname( __FILE__ ) ) );
					$path           = ltrim( end( $path ), '/' );
					self::$paths['dir'] = get_stylesheet_directory() . trailingslashit( '/' . $path );
					self::$paths['uri'] = get_stylesheet_directory_uri() . trailingslashit( '/' . $path );
					break;
				default:
					self::$paths['dir'] = trailingslashit( plugin_dir_path( __FILE__ ) );
					self::$paths['uri'] = plugin_dir_url( __FILE__ );
					break;
			}
			if ( null !== $key ) {
				return self::$paths[ $key ];
			}
			return self::$paths;
		}

		/**
		 * Register scripts
		 *
		 * @since 1.0.0
		 */
		public function admin_scripts() {
			wp_register_style( 'ao-style', AO_CSS_URI . 'main.css', array(), '1.0' );
			wp_register_script( 'ao-options', AO_JS_URI . 'ann-options.js', array( 'jquery-core' ), '1.0', true );

			//wp_enqueue_style( 'ao-style' );
			//wp_enqueue_script( 'ao-options' );
		}

		public static function page()  {
			return AO_Manager::run();
		}


	}
}



/**
 * Main Instance of annOptions
 *
 *
 * @since 1.0.0
 *
 * @return annOptions
 */
function ann_options( $object = null ) {
	$options = annOptions::init();
	if ( 'page' === $object ) {
		return $options::page();
	}
	return $options;
}
$ann_opt = ann_options();

/**
 * Demo Data used for development.
 */
require_once( AO_INC_DIR . '/demo2.php' );
