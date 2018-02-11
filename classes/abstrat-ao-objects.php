<?php
/**
 * AO Objects
 *
 * AO Objects is parent class meant to extend by childs.
 *
 * @package annOptions
 * @since 1.0.0
 */
abstract class AO_Objects {


	protected $obj_type = 'ao_object';
	protected $defaults;
	protected $req_fields;

	public $ID;
	public $slug;
	public $title;
	public $htmlID;
	public $htmlClass;
	public $description;
	public $position;

	public static $instance_count = 0;
	public $count = 0;

	public $error_status = false;

	public function __construct( $args, $obj_type )  {

		$this->count 		= $this->instanceCount( self::$instance_count += 1 );
		$this->defaults 	= $this->setDefaults( $obj_type );
		$this->obj_type 	= $obj_type;
		$this->req_fields 	= apply_filters( 'ao_'. $obj_type . '_obj_required_fields', $this->required() );
		$this->htmlID 		= $this->htmlID( $args['slug'], $obj_type );
		$classes			= ( ! ao_is_null( $args['eclass'] ) ) ? $this->validate( $args['eclass'], $obj_type, 'eclass' ) : '';
		$this->htmlClass 	= $this->htmlClasses( $classes, $obj_type );

	}
	protected function validate( $data, $obj_type, $input_type )  {
		if ( is_wp_error( $data ) ) {
			return $data;
		}
		//return apply_filters( 'ao_validate_obj_'. $obj_type, $data, $input_type );

		/**
		 * Filter input.
		 *
		 * The `$obj_type` variable contains string value of
		 * extended object type. for example page | panel | field.
		 * eg: ao_validate_obj_{page}
		 *
		 * @see extended classes from `AO_Objects` for more filters.
		 *
		 * @package annOptions
		 * @since 1.0.0
		 */
		if ( has_filter( 'ao_validate_obj_'. $obj_type ) ) {
			return apply_filters( 'ao_validate_obj_'. $obj_type, $data, $input_type );
		}
		else {
			/**
			 * Basic tic toc validation.
			 * For More accurate validations use above filter.
			 */
			switch ( $input_type ) {
				case 'slug':
					return sanitize_title( $data );
				break;
				case 'title':
				case 'menu_title':
				case 'page_title':
					if( strlen( $data ) <= 40 ) {
						return esc_html( $data );
					}
					else {
						return ao_add_error( 'lengthy_title', 'Maximum 40 characters allowed.' );
					}
				break;
				case 'position':
					return absint( $data );
				break;
				case 'eclass':
					return sanitize_html_class( $data );
				break;

				default:
					return $data;
				break;
			}
		}
	}

	public function defaults()  {
		return array(
			'ID'			=> null,
			'slug'			=> null,
			'title'			=> null,
			'icon'			=> 'dashicons-admin-settings',
			'position'		=> null,
			'description'	=> null
		);
	}

	public function setDefaults( $obj_type )  {
		return apply_filters( 'ao_'. $obj_type . '_obj_default_fields', $this->defaults() );
	}


	public function setArgs( $args, $defaults )  {
		return wp_parse_args( $args, $defaults );
	}

	public function keys( $args ) {
		return array_keys( $args );
	}

	public function required()  {
		return array(
			'slug',
			'title'
		);
	}

	protected function position( $pos = null ) {
		if ( null !== $pos ) {
			return (int) $pos;
		}
		return (int) ( $this->count * 5 );
	}

	protected function instanceCount( $count = 0 )  {
		if ( 0 !== self::$instance_count ) {
			$this->count = $count;
		}
		else {
			$this->count = self::$instance_count;
		}
		return $this->count;
	}

	protected function htmlID( $slug, $obj_type )  {
		return ao_html_unqid( $slug, 'ao-'. $obj_type );
	}

	protected function htmlClasses( $classes = null, $obj_type )  {
		$class = 'ao-object ao-type-'. $obj_type .' '. $this->htmlID;
		if ( ! ao_is_null( $classes ) ) {
			return $class .' '. $classes;
		}
		return $class;
	}

}
