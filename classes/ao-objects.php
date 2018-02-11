<?php
/**
 * AO Objects
 *
 * AO Objects is parent class meant to extend by childs.
 *
 * @package annOptions
 * @since 1.0.0
 */
class AO_Objects {

	public $ID;
	public $slug;
	public $title;
	public $htmlID;
	public $htmlClass;
	public $description;

	private static $instance_count = 0;
	public $count = 0;
	public $position;

	public function __construct( $args, $type = null ) {

		$count 		= instanceCount();
		$type 		= ( null !== $type ) ? $type : 'object';
		$defaults 	= apply_filters( 'ao_'. $type . 'obj_default_fields', $this->defaults() );
		$args     	= wp_parse_args( $args, $defaults );
		$req_fields = apply_filters( 'ao_'. $type . 'obj_required_fields', $this->requires() );

		foreach ( (array) $this->keys( $args ) as $key ) {

		}
	}

	protected function validate( $data, $type )  {
		if ( is_wp_error( $data ) ) {
			return;
		}
		return apply_filters( 'ao_validate_init', $data, $type );
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

	public function keys( $args ) {
		return array_keys( $args );
	}

	public function required()  {
		return array(
			'slug',
			'title'
		);
	}

	protected position( $pos = null ) {
		if ( null !== $pos ) {
			return (int) $pos;
		}
		return (int) ( $this->count * 5 );
	}

	protected function instanceCount()  {
		self::$instance_count += 1;
		$this->count = self::$instance_count;
		return $this->count;
	}

}
