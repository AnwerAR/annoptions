<?php
/**
 * This Class is responsible to set
 */
defined( 'AO_VERSION' ) or die( 'Oh! No script kiddies please.' );

class ao_api  {
/**
 * Simply Singleton ( ~_~ )
 *
 * @package annOptions
 * @since 1.0.0
 **/
private static $_instance = null;

/**
 * Input storage for page, section, field. pages, sections & fields.
 *
 * @package annOptions
 * @since 1.0.0
 **/
public $options;

/**
 * Input storage for pages after validating input.
 *
 * @package annOptions
 * @since 1.0.0
 **/
private $page;

/**
 * Input storage for sections after validating input.
 *
 * @package annOptions
 * @since 1.0.0
 **/
private $sections;

/**
 * Input storage for fields after validating input.
 *
 * @package annOptions
 * @since 1.0.0
 **/
private $fields;

/**
 * Error Storage mainly for avoiding duplicate pages, sections & fields.
 * Note: This Feature will maybe introduce in future releases.
 *
 * @package annOptions
 * @since 1.0.0
 **/
//public $errors;

/**
 * Private constructor will fire functions hooked with 'ao_options'.
 * Used to pass inputs via hooked function.
 *
 * @package annOptions
 * @since 1.0.0
 **/

public $has_choice = array( 'select', 'multiselect', 'radio', 'checkbox' );
private function __construct() {

  # Access this class.
  do_action( 'ao_options', $this );
  echo "<pre>";
  //print_r($this->fields);
  echo "</pre>";

}

/**
 * Run Once & have only single instance.
 *
 * @package annOptions
 * @since 1.0.0
 **/
public static function run() {
  if ( null === self::$_instance ) {
    self::$_instance = new AO_API();
  }
  return self::$_instance;
}

/**
 * Get Pages.
 *
 * @package annOptions
 * @since 1.0.0
 **/
public function getPages() {
  return $this->page;
}

/**
 * Get Sections.
 *
 * @package annOptions
 * @since 1.0.0
 **/
public function getSections() {
  return $this->sections;
}

/**
 * Get Fields.
 *
 * @package annOptions
 * @since 1.0.0
 **/
public function getFields() {
  return $this->fields;
}

/**
 * Add Bulk Pages.
 *
 * @package annOptions
 * @since 1.0.0
 **/
public function addPages( $pages = null ) {

# Saftly exit when the paramater is not a valid array.
if ( ! is_array( $pages ) ) return;

# Store sections and fields if found in page array. otherwise set to null.
//$sections = $new_section = $fields = null;

# Iterate Through supplied Inputs.
foreach ( $pages as $page ) {
  $this->addPage( $page );
} // End of Main loop.
} // end of method ( addPages )


/**
 * Add Bulk Sctions.
 *
 * @package annOptions
 * @since 1.0.0
 **/
public function addSections( $page = null, $sections = null ) {

# Page does't exists? Page null? dont worry saftely exit.
if ( null == $page || null == $sections  ) return;

# Iterate sections.
foreach ( $sections as $section ) {

# add to sections property.
$this->addSection( $page, $section );
} // End of foreach.
} // End of method ( addSections )

/**
 * Add Bulk Fields.
 *
 * @package annOptions
 * @since 1.0.0
 **/
public function addFields( $section = null, $fields = null ) {

# Section does't exists OR null? dont worry saftely exit.
if ( null == $section || null == $fields  ) return;

foreach ( $fields as $field ) {

# Add to fields Property.
$this->addField( $section, $field );
} // End of foreach.
} // End of method ( addFields )

/**
 * Add page.
 *
 * @package annOptions
 * @since 1.0.0
 **/
public function addPage( $page = array() ) {

$page = array_merge(
  array(
    'page_title' => null,
    'menu_title' => '',
    'cap' => 'manage_options',
    'slug' => null,
    'type' => 'menu',
    'parent' => null,
    'icon' => 'dashicons-admin-generic',
    'position' => null,
    'desc' => '',
    'sections'  => null
  ), $page
);

if ( null == $page['page_title'] || null == $page['slug'] ) return;

# If someone tries to override an existing page.
if ( isset( $this->page[ $page['slug'] ] ) ) {

# Note: Due to some minor issues this feature is not added in current version.
# Hope to see this in future releases.
# $this->errors[$page['slug']] = __( 'already exists' );

# then deny.
return;
}
if ( '' == $page['menu_title'] ) $page['menu_title'] = $page['page_title'];


# If not set the default type is "menu".
$allowed_types = array( 'menu', 'submenu', 'dashboard' );
if ( ! in_array( $page['type'], $allowed_types ) ) $page['type'] = 'menu';

switch ( ao_initialize::mode() ) {
  case '_PLUGIN_':
    $parent = 'themes.php';
  break;
  default:
    $parent = 'settings.php';
  break;
}

if ( $page['type'] == 'submenu' && null === $page['parent'] ) $page['parent'] = $parent;

if ( array_key_exists( 'sections', $page ) ) {
  $this->addSections( $page['slug'], $page['sections'] );
  unset( $page['sections'] );
}

$this->page[ $page['slug'] ] = $page;
}

/**
 * Input section.
 *
 * @package annOptions
 * @since 1.0.0
 **/


public function addSection( $page = null, $section = array() ) {

// Page does't exists? Page null? dont worry saftely terminate.
if ( null == $page  ) return;

$section = array_merge(
  array(
    'id'    => null,
    'desc'  => null,
    'fields'=> null
  ), $section
);

if ( null == $section['id'] ) return;

if ( null !== $section['fields'] ) {
  $this->addFields( $section['id'], $section['fields']);
  unset( $section['fields'] );
}

$section['page'] = $page;

$this->sections[ $section['id'] ] = $section;
}

/**
 * Input field.
 *
 * @package annOptions
 * @since 1.0.0
 **/
public function addField( $section = null, $field = array() ) {

if ( null == $section  ) return;

$field['section'] = $section;


if ( 'repeator' != $field['type'] ) {

  $this->fields[ $field['id'] ] = $this->validate_input_field( $field );
}
else {
  $repeator_fields = $field['fields'];
  unset( $field['fields'] );

  $this->fields[ $field['id'] ] = $this->validate_input_field( $field );
  foreach ( $repeator_fields as $repeator_key => $repeator ) {
    $repeator['eclass'] .= ' ao-repeator-field';
    $repeator['repeator'] = true;

    $this->fields[ $field['id'] ]['fields'][ $repeator['id'] ] = $this->validate_input_field( $repeator );
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
    $input['id'] = esc_html( sanitize_title( $input['id'] ) );
    $input['title'] = esc_html( wp_strip_all_tags( $input['title'], true ) );
  }
    $input['type'] = sanitize_title( $input['type'] );


  if ( in_array( $input['type'], $this->has_choice ) && null === $input['choices'] ) return;

  $input['eclass'] = explode( ' ', $input['eclass'] );
  if ( array_key_exists( 'repeator', $input ) and $input['repeator'] == true ) {
    $input['eclass'][] = 'ao-repeator-'.$input['type'];
  }
  else {
    $input['eclass'][] = 'ao-'.$input['type'];
  }


  return $output = $input;
}

} // END OF CLASS
