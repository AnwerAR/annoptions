<?php
/**
 * Input type checkbox output
 */
class AO_Input_Type_repeater extends AO_Input_Types
{
    public function output()
    {
        //print_r($this->field);
        echo "<div class='ao-repeater-wrapper'>";
        echo "<div class='{$this->classes}' data-repeater-list='{$this->getName($this->field['id'])}'>";
        echo "<div data-repeater-item>";


        $counter = '';
        foreach ($this->field['fields'] as $field => $field_value) {
            $counter++;

            if ('' != $field_value['type']) {
                $class = 'AO_Input_Type_'.$field_value['type'];

                if (class_exists($class)) {
                    $id = $field_value['id'];
                    $field_value['is_rep_field'] = true;
                    $field_value['repeater_section'] = $this->field['id'];
                    $field_value['default'] = 'some';
                    //$avl = $this->field['id'][$field_value['id']];
                    $avl = array(

               $this->field['id'] => [$field_value['id']]
             );
                    //echo $field_value['id'];
                    new $class($field_value);
                } else {
                    echo 'Class <code>'. $class .'</code> not exists';
                }
            }
        }
        echo '<input data-repeater-delete type="button" value="Delete"/>';
        echo "</div>";
        echo "</div>";
        echo "<input data-repeater-create type='button' value='Add'/>";

        echo "</div><div class='ao-repeater-wrapper2'></div>";


        //return $output;
    }
}