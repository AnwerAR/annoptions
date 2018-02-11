<?php
/**
 * Lorem ipsum dolor sit amet flang fistan.
 *
 * @since 1.0.0
 **/

class AO_Page_Manager {

	public $ID;
	public $htmlID;
	public $menu_title;
	public $page_title;
	public $slug;
	public $capability = 'manage_options';
	public $callable;
	public $icon;
	public $position;

	public static $instance_count = 0;
	public $count = 0;
	private $required = array();
	public $error_status = false;
	public $panels = array();
	public static $pansss = 'nulllll';
	public function __construct( $args ) {

		$this->allowed_page_types();
		$keys = array_keys ( $this->setDefault() );

		foreach ( $keys as $key ) {

			if ( ! array_key_exists( $key, $args ) || ao_is_null( $args[ $key ] ) ) {
				$args[ $key ] = $this->setDefault( $key );
			}

			if ( in_array( $key,  $this->required() ) && null === $args[ $key ] ) {
				$this->$key = ao_add_error( 'missing_required', 'This required field is either not set or contain illegal characters.' );
			}
			else {
				$this->$key = $args[ $key ];
			}

			if ( ! is_wp_error( $this->$key ) ) {
				$this->$key = $this->validate( $this->$key, $key );
			}
		}

		$this->page_title = $this->title( $this->page_title, $this->menu_title );
		$this->htmlID = ao_html_unqid( $this->slug, 'ao-page' );
		self::$instance_count += 1;
		$this->count = self::$instance_count;
	}

	protected function title( $page_title, $menu_title )  {
		if( ! ao_is_null( $page_title ) || ! is_wp_error( $menu_title ) ) {
			return $menu_title;
		}
	}

	private function validate( $data, $key )  {

		if ( is_wp_error( $data ) ) {
			return;
		}
		switch ( $key ) {
			case 'slug':
				return sanitize_title( $data );
			break;
			case 'type':
				if ( ! preg_match('/[^a-z]/i', $data ) && in_array( $data, $this->allowed_page_types(), true ) ) {
					return $data;
				}
				else {
					return ao_add_error( 'illegal_type', 'Not valid type.' );
				}

			break;
			case 'menu_title':
			case 'page_title':
				if( strlen( $data ) <= 40 ) {
					return esc_html( $data );
				}
				else {
					return ao_add_error( 'lengthy_title', 'Maximum 40 characters allowed.' );
				}
			break;
			case 'type':
				return absint( $data ) || ao_add_error( 'not_int', 'Not an integar.' );
			break;

			/**
			 * This validation method is not complete.
			 *
			 * @todo Add more cases for remaning page fields.
			 */
			default:
				return $data;
			break;
		}
	}

	private function setDefault( $key = null )  {
		$defaults = apply_filters( 'ao_page_defaults', array(
				'ID'			=> null,
				'slug'			=> null,
				'page_title'	=> null,
				'menu_title'	=> null,
				'capability'	=> 'manage_options',
				'icon'			=> 'dashicons-admin-settings',
				'position'		=> null,
				'callback'		=> null,
				'type'			=> 'menu',
				'parent'		=> null,
				'description'	=> null,
				//'panels'		=> null
			)
		);

		if ( null != $key && array_key_exists( $key, $defaults ) ) {
			return $defaults[ $key ];
		}
		return $defaults;
	}

	private function required()  {
		return apply_filters( 'ao_page_required_fields', array(
			'slug',
			'menu_title'
		));
	}

	private function allowed_page_types()  {
		return apply_filters( 'ao_allowed_page_types', array(
			  'menu',
			  'submenu',
			  'dashboard',
			  'posts',
			  'media',
			  'pages',
			  'comments',
			  'theme',
			  'plugins',
			  'users',
			  'management',
			  'options'
		  	)
		);
	}

	protected function htmlClasses( $classes ) {

	}
}
