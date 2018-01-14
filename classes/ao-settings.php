<?php
/**
 * This Class is responsible to set
 */
defined( 'AO_VERSION' ) or die( 'Oh! No script kiddies please.' );
require_once AO_DIR . 'classes/ao-class-page-manager.php';

/**
 *
 * Class ao_settings description
 *
 * @author Anwer AR
 */
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

		include_once AO_DIR . 'new-classes/ao-page-settings.php';
		if ( $this->pagess[ $args['slug'] ] instanceof AO_Page_Settings ) {
			//$args['slug']    = $args['slug'] . 'some';
			return;
		}
		// else {
		$page = new AO_Page_Settings( $this, $args );
		// }
		$this->pagess[ $page->slug ] = $page;
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

} // END of Class.
