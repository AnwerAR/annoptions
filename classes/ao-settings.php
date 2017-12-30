<?php
/**
 * This Class is responsible to set
 */
defined( 'AO_VERSION' ) or die( 'Oh! No script kiddies please.' );
require_once AO_DIR . 'classes/ao-class-page-manager.php';

class ao_settings {

	private static $_instance = null;

	public $options;
	private $page;
	public $pagess = array();
	private $sections;
	private $fields;
	public $errors;
	public $input_types;
	public $page_types;
	public $repeaters  = array();
	public $has_choice = array( 'select', 'multiselect', 'radio', 'checkbox' );

	private function __construct() {
		do_action( 'annframe_options', $this );
	}
	public static function run() {
		if ( null === self::$_instance ) {
			self::$_instance = new ao_settings();
		}
		return self::$_instance;
	}

	public function getPages() {
	}
	public function getSections() {
	}
	public function getFields() {
	}

	public function addPages() {
	}
	public function addSections() {
	}
	public function addFields() {
	}
	public function addPage( $context = array(), $args ) {
		include_once AO_DIR . 'classes/ao-class-page-manager.php';
		if ( $this->pagess[ $args['ID'] ] instanceof AO_Page_Manager ) {
			$args['other'] = 'already added page';
			$args['ID']    = $args['ID'] . 'some';
		}
		// else {
		$page = new AO_Page_Manager( $this, $context, $args );
		// }
		$this->pagess[ $page->ID ] = $page;
		return $page;
	}

	public function addSection() {
	}

	public function addField( $section = null, $field = array() ) {
		// if ( null === $section ) return;
		if ( 'repeater' != $field['type'] ) {
			$this->fields[ $field['id'] ] = $this->validate_input_field( $field );
		} else {
			$repeater_fields = $field['fields'];
			unset( $field['fields'] );
			$this->fields[ $field['id']['so'] ] = $this->validate_input_field( $field );

			$id = $field['id'];
			foreach ( $repeater_fields as $repeater_key => $repeater ) {
				$this->fields[ $id ]['fields'][] = $this->validate_input_field( $repeater );
			}
		}
	}

	private function validate_input_field( $input = array() ) {
		$input = array_merge(
			array(
				'id'          => null,
				'title'       => null,
				'type'        => 'text',
				'choices'     => null,
				'eclass'      => '',
				'default'     => null,
				'placeholder' => null,
				'fields'      => null,
			),
			$input
		);

		if ( null === $input['id'] || null === $input['title'] ) {
			return; // Terminate silently.
		} else {
			$input['id']    = esc_html( $input['id'] );
			$input['title'] = esc_html( $input['title'] );
		}

		// if( ! in_array( $input['type'], $this->input_types ) || null == $input['type'] ) return;
		if ( in_array( $input['type'], $this->has_choice ) && null === $input['choices'] ) {
			return;
		}

		// do something for eclass.
		// do something with defaultvalue.
		// do something with placeholder.
		// do somethig with fields.
		$output = $input;
		return $output;
	}
	public function setPage() {
	}
	public function setSection() {
	}
	public function setField() {
	}

	public function removePage() {
	}
	public function removeSection() {
	}
	public function removeField() {
	}

	private function input_field_classes( $field ) {
	}

	public function input_types() {
		// $input_types = array(
		// 'text' => array( 'type => 'text', 'classs' => 'form-control' )
		// );
		// $this->input_types = apply_filters( 'annframe_input_types', $input_types );
	}
} // END of Class.
