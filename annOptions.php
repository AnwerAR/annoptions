<?php
/**
 * Simple yet powerfull framework for adding custom option pages on the go.
 *
 *   Plugin Name: annOptions
 *   Plugin URI: https://github.com/AnwerAR/annOptions
 *   Description: Simple yet powerfull framework for adding custom option pages on the GO!
 *   Version: 1.0.0
 *   Author: Anwer Abdul Rehman
 *   Author URI: http://annframe.com
 *   License: GPL2
 *
 * @package annOptions
 * @version 1.0.0
 * @author  Anwer Abdul Rehman
 * @link    http://annframe.com/annOptions
 **/
 // Constants.
defined( 'ABSPATH' ) or die( 'Oh! No script kiddies please.' );

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
 * Application Version
 *
 * @package annOptions
 * @since   1.0.0
 */
define( 'AO_VERSION', '1.0.0' );

/**
 * Auto Load classes.
 *
 * @package annOptions
 * @since   1.0.0
 */
/**
 * Classes auto loader.
 */
require_once trailingslashit( plugin_dir_path( __FILE__ ) ) . 'classes/ao-autoloader.php';


require_once trailingslashit( plugin_dir_path( __FILE__ ) ) . 'includes/helpers.php';
require_once trailingslashit( plugin_dir_path( __FILE__ ) ) . 'includes/demo.php';
$ao_path = ao_initialize::paths();

/**
 * Constants.
 *
 * @package annOptions
 * @since   1.0.0
 */
define( 'AO_DIR', $ao_path->dir );
define( 'AO_URI', $ao_path->uri );
define( 'AO_INC_DIR', AO_DIR . 'includes' );
define( 'AO_INC_URI', AO_URI . 'includes' );
define( 'AO_ASSETS_DIR', AO_DIR . 'dist' );
define( 'AO_ASSETS_URI', AO_URI . 'dist' );
define( 'AO_CSS_DIR', AO_ASSETS_DIR . trailingslashit( '/css' ) );
define( 'AO_CSS_URI', AO_ASSETS_URI . trailingslashit( '/css' ) );
define( 'AO_JS_DIR', AO_ASSETS_DIR . trailingslashit( '/js' ) );
define( 'AO_JS_URI', AO_ASSETS_URI . trailingslashit( '/js' ) );
define( 'AO_FONTS_DIR', AO_ASSETS_DIR . trailingslashit( '/fonts' ) );
define( 'AO_FONTS_URI', AO_ASSETS_URI . trailingslashit( '/fonts' ) );
define( 'AO_IMG_DIR', AO_ASSETS_DIR . trailingslashit( '/images' ) );
define( 'AO_IMG_URI', AO_ASSETS_URI . trailingslashit( '/images' ) );

add_action( 'init', array( 'ao_api', 'run' ), 5 );
add_action(
	'ao_options', function ( $options ) {
		$setPage = new AO_Admin_Registers();
		if ( null != $options->getPages() ) {
			$setPage->pageInit( $options->getPages() );
			add_action( 'admin_enqueue_scripts', 'ao_admin_print_scripts' );
		}

		if ( null != $options->getSections() ) {
			$setPage->sectionInit( $options->getSections() );
		}

		if ( null != $options->getFields() ) {
			$setPage->fieldInit( $options->getFields() );
		}
	}
);


function ao_admin_print_scripts() {
	wp_register_style( 'ao-style', AO_CSS_URI . 'main.css', array(), '1.0' );
	wp_register_script( 'ao-options', AO_JS_URI . 'ann-options.js', array( 'jquery-core' ), '1.0', true );
	wp_enqueue_style( 'ao-style' );
	wp_enqueue_script( 'ao-options' );
}

// @Temp for testing feature changings in AO_API
// Supposed to remove
require_once AO_DIR . 'classes/ao-settings.php';
$default_args = array(
	'page_title'  => 'Page One',
	'menu_title'  => 'Page One',
	'slug'		=> 'page-one',
	'cap'         => 'edit_themes',
	'type'        => 'menu',
	'parent'      => '',
	'icon'        => 'dashboard-settings',
	'position'    => 15,
	'description' => 'Lorem ipsum dolor sit amet',
	'sections'    => array(),
);
add_action(
	'annframe_options', function ( $pages ) {
		$pages->addPage(
			'appreance', array(
				'page_title'  => 'Page One',
				'menu_title'  => 'Page One',
				'slug'		=> 'page-one',
				'cap'         => 'edit_themes',
				'type'        => 'menu',
				'parent'      => '',
				'icon'        => 'dashboard-settings',
				'position'    => 15,
				'description' => 'Lorem ipsum dolor sit amet',
				'sections'    => array(),
		));
		$pages->addPage(
			'appreance', array(
				'page_title'  => 'Page One',
				'menu_title'  => 'Page One',
				'slug'		=> 'page-one',
				'cap'         => 'edit_themes',
				'type'        => 'menu',
				'parent'      => '',
				'icon'        => 'dashboard-settings',
				'position'    => 15,
				'description' => 'Lorem ipsum dolor sit amet',
				'sections'    => array(),
		));
		$pages->addPage(
			'appreance', array(
				'page_title'  => 'Page One',
				'menu_title'  => 'Page One',
				'slug'		=> 'page-one',
				'cap'         => 'edit_themes',
				'type'        => 'menu',
				'parent'      => '',
				'icon'        => 'dashboard-settings',
				'position'    => 15,
				'description' => 'Lorem ipsum dolor sit amet',
				'sections'    => array(),
		));
	}
);

add_action(
	'init', function () {
		global $pages;
		print_r( ao_settings::run() );
	}
);
