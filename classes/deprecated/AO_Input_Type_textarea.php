<?php

class AO_Input_Type_textarea extends AO_Input_Types {

public function output() {
$output  = '<textarea type="number"';
$output .= 'name="'. $this->getName( $this->field['id'] ) .'"';
//$output .= 'value="'. $this->getValue( $this->field['id'], $this->field['default'] ) .'"';
$output .= "placeholder='{$this->field['placeholder']}'";
$output .= 'class="'. $this->classes .'"';
$output .= '">'. $this->getValue( $this->field['id'], $this->field['default'] ) .'</textarea>';
return $output;
}
}
