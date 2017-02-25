<?php
/**
 *
 */
class AO_Input_Type_multiselect extends AO_Input_Types {

  public function output() {

  $output  = '<select class="'. $this->classes .'" name="'. $this->getName( $this->field['id'] ) .'[]" data-placeholder="'. $this->field['placeholder'] .'" multiple="multiple">';

  foreach ( (array) $this->field['choices'] as $key => $value ) {
  $output .= '<option value="'. $key .'"';

  if ( is_array( $this->getValue( $this->field['id'] ) )) {
    foreach ( $this->getValue( $this->field['id'] ) as $selected_key => $selected_value) {
      $output .= selected( $selected_value, $key, false );
    }
  }
  $output .=  '>'.$value .'</option>';
  }
  $output .= '</select>';

  return $output;
  }
}
