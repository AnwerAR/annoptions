<?php

class AO_Input_Type_select extends AO_Input_Types {

public function output() {

$output  = '<select class="'. $this->classes .'" name="'. $this->getName( $this->field['id'] ) .'" data-placeholder="'. $this->field['placeholder'] .'">';

foreach ( (array) $this->field['choices'] as $key => $value ) {
$output .= '<option value="'. $key .'"'. selected( $this->getValue( $this->field['id'], $this->field['default'] ), $key, false ).'> '. $value .' </option>';
}
$output .= '</select>';

return $output;
}

}
