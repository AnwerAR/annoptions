<?php
/**
 * Input type checkbox output
 */
class AO_Input_Type_radio extends AO_Input_Types
{

  public function output() {
    $output = '';
    $count = 0;
    foreach ( (array) $this->field['choices'] as $key => $value ) {
      $count++;

      $output .= "<input class='{$this->classes}' type='radio' name='{$this->getName( $this->field['id'] )}' value='{$key}' id='{$this->field['id']}-{$count}'";

      
      $output .= ( $this->getValue( $this->field['id'] ) == $key) ? 'checked="checked"' : '';

      $output .= ">";
      $output .= "<label for='{$this->field['id']}-{$count}'>{$value}</label>";
    }
    return $output;
  }
}
