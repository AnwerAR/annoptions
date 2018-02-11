<?php
/**
 * AO Panel Class
 *
 * Calls by AO_Manager to build Panel data.
 *
 * @package annOptions
 * @since 1.0.0
 */

 /**
  * Summary
  */
 require_once( __DIR__ . '/abstrat-ao-objects.php' );
 class AO_Panel extends AO_Objects {

	public $parents = null;

	/**
	 * Initialize Panel
	 *
	 * Build a Panel object from user input.
	 *
	 * @package annOptions
	 * @since 1.0.0
	 *
	 * @param array $args array containing panel data.
	 * @param string $obj_type - panel
	 * @param string $parent_slug Custom Options page slug | null in case of customizer.
	 * @return AO_Panel - Panel Object.
	 */
	public function __construct( $args, $obj_type = null, $parent_slug = null ) {

		parent::__construct( $args, $obj_type );

		$args  = wp_parse_args( $args, $this->defaults );
		// echo "<pre>";
		// print_r( $this->req_fields );
		// echo "</pre>";
		foreach ( (array) $this->keys( $args ) as $key ) {
			if ( ao_is_null( $args[ $key ] ) && in_array( $key, $this->req_fields ) ) {
				$args[ $key ] = ao_add_error( 'missing_required', 'This field is required.' );
			}

			$this->$key = $this->validate( $args[ $key ], $obj_type, $key );

			if ( is_wp_error( $this->$key )) {
				$this->error_status = true;
			}

		}

		print_r( $req_fields );
		//$this->instanceCount( self::$instance_count += 1 );
		$this->position = $this->position();

		$this->setScope( $parent_slug );
		//usort( $this );
		unset( $this->defaults );
		unset( $this->obj_type );
		unset( $this->req_fields );
	}

	public function setScope( $parent_slug )  {
		if ( is_array( $parent_slug ) ) {
			foreach ( $parent_slug as $slug ) {
				if ( ao_is_null( $this->parents ) || is_array( $this->parents ) && ! in_array( $slug, $this->parents ) ) {
					$this->parents[] = $slug;
				}
			}
		}
		else {
			if ( ao_is_null( $this->parents ) || is_array( $this->parents ) && ! in_array( $parent_slug, $this->parents ) ) {
				$this->parents[] = $parent_slug;
			}
		}
	}
 }
