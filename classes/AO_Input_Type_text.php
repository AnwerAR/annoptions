<?php

class AO_Input_Type_text extends AO_Input_Types {

  public function output() {

  $output  = '<input type="'. $this->field['type'] .'"';
  $output .= 'name="'. $this->getName( $this->field['id'] ) .'"';
  $output .= 'value="'. $this->getValue( $this->field['id'], $this->field['default'] ) .'"';
  $output .= "placeholder='{$this->field['placeholder']}'";
  $output .= 'class="'. $this->classes .'"';
  $output .= '">';

  return $output;
  }
}
if ( ! class_exists( 'AO_Input_Type_tel') ) { class AO_Input_Type_tel extends AO_Input_Type_text {} }
if ( ! class_exists( 'AO_Input_Type_email') ) { class AO_Input_Type_email extends AO_Input_Type_text {} }
if ( ! class_exists( 'AO_Input_Type_url') ) { class AO_Input_Type_url extends AO_Input_Type_text {} }
if ( ! class_exists( 'AO_Input_Type_number') ) { class AO_Input_Type_number extends AO_Input_Type_text {} }
