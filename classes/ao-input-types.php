<?php

class AO_Input_Types {

	public $classes;
	public $field;

	public function __construct( $field ) {

		if ( is_array( $field['eclass'] ) ) {
			$this->classes = implode( ' ', $field['eclass'] );
		}

		$this->field = $field;
		print $this->output();
	}

	public function output() {

		// Meant to extend.
	}

	public function getName( $name, $option = 'ao_options' ) {

		$this->name = $option . "[{$name}]";
		return $this->name;
	}

	public static function fieldName( $name, $option = 'ao_options' ) {

		$name = $option . "[{$name}]";
		return $name;
	}

	public function getValue( $id, $default = null, $option = 'ao_options' ) {

		$option = (array) get_option( $option );

		if ( isset( $option[ $id ] ) ) {
			if ( null == $option[ $id ] ) {
				$option = $default;
			} else {
				$option = $option[ $id ];
			}
		} else {
			$option = $default;
		}
		return $option;
	}

	public static function fieldValue( $id, $default = null, $option = 'ao_options' ) {

		$option = (array) get_option( $option );

		if ( isset( $option[ $id ] ) ) {
			if ( null == $option[ $id ] ) {
				$option = $default;
			} else {
				$option = $option[ $id ];
			}
		} else {
			$option = $default;
		}
		return $option;
	}
} // End of Class.
