<?php
/**
 * Input type checkbox output
 */
class AO_Input_Type_repeater extends AO_Input_Types
{

public function output() {


//print_r($this->field);
echo "<div class='ao-repeater-wrapper'>";


$repeater_values = (array) $this->getValue( $this->field['id'] );
echo "<div class='{$this->classes}' data-repeater-list='{$this->getName( $this->field['id'] )}'>";

foreach ( $repeater_values as $repeater_keys => $repeater_value ) {

echo "<div data-repeater-item>";

        foreach ( (array) $this->field['fields'] as $field_key => $field_value ) {
          $class = 'AO_Input_Type_'.$field_value['type'];
          
          if ( array_key_exists( $field_value['id'], $repeater_value ) && '' != $repeater_value[ $field_value['id'] ] ) {
            $field_value['default'] = $repeater_value[ $field_value['id'] ];
          }
          else{
            $field_value['default'] = null;
          }

              new $class( $field_value );

      }
      echo '<input data-repeater-delete type="button" value="Delete"/>';

      echo "</div>";



    }
    echo "</div>";
    echo "<input data-repeater-create type='button' value='Add'/>";
    echo "</div>";





    //return $output;
  }
}
