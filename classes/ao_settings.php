<?php
/**
 * This Class is responsible to set
 */
defined( 'AO_VERSION' ) or die( 'Oh! No script kiddies please.' );

class ao_settings  {

private static $_instance = null;

public  $options;
private $page;
private $sections;
private $fields;
public  $errors;
public  $input_types;
public  $page_types;
public  $repeators = array();
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

public function getPages() {}
public function getSections() {}
public function getFields() {}

public function addPages() {}
public function addSections() {}
public function addFields() {}

public function addPage() {}
public function addSection() {}

public function addField( $section= null, $field = array() ) {
  //if ( null === $section ) return;
  echo "<pre>";
  print_r($field);
  echo "</pre>";
  if ( 'repeator' != $field['type'] ) {
    $this->fields[ $field['id'] ] = $this->validate_input_field( $field );
  }
  else {
    $repeator_fields = $field['fields'];
    unset( $field['fields'] );
    $this->fields[ $field['id']['so'] ] = $this->validate_input_field( $field );

    $id = $field['id'];
    foreach ( $repeator_fields as $repeator_key => $repeator ) {
      $this->fields[ $id ]['fields'][] = $this->validate_input_field( $repeator );
    }
  }
}

private function validate_input_field( $input = array() ) {
  

  $input = array_merge(
    array(
      'id'    => null,
      'title' => null,
      'type'  => 'text',
      'choices' => null,
      'eclass'  => '',
      'default' => null,
      'placeholder' => null,
      'fields'    => null
    ), $input
  );

  if ( null === $input['id'] || null === $input['title'] ) {
    return; # Terminate silently.
  }
  else {
    $input['id'] = esc_html( $input['id'] );
    $input['title'] = esc_html( $input['title'] );
  }

  //if( ! in_array( $input['type'], $this->input_types ) || null == $input['type'] ) return;

  if ( in_array( $input['type'], $this->has_choice ) && null === $input['choices'] ) return;

  // do something for eclass.

  // do something with defaultvalue.

  // do something with placeholder.

  // do somethig with fields.

  $output = $input;
  return $output;
}
public function setPage() {}
public function setSection() {}
public function setField() {}

public function removePage() {}
public function removeSection() {}
public function removeField() {}

private function input_field_classes( $field ) {}

public function input_types() {
 $input_types = array(
    'text' => array( 'type => 'text', 'class' => 'form-control' )
 );
 $this->input_types = apply_filters( 'annframe_input_types', $input_types );
}
} // END of Class.
