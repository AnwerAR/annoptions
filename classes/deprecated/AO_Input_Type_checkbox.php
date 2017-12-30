<?php
/**
 * Input type checkbox output
 */
class AO_Input_Type_checkbox extends AO_Input_Types
{
    public function output()
    {
        $output = '';
        $count = 0;
        foreach ((array) $this->field['choices'] as $key => $value) {
            $count++;

            $output .= "<input class='{$this->classes}' type='checkbox' name='{$this->getName($this->field['id'])}[$count]' value='{$key}' id='{$this->field['id']}-{$count}'";

            if (is_array($this->getValue($this->field['id']))) {
                foreach ($this->getValue($this->field['id']) as $select_key => $select_val) {
                    $output .= ($select_val == $key) ? 'checked="checked"' : '';
                }
            }

            $output .= ">";
            $output .= "<label for='{$this->field['id']}-{$count}'>{$value}</label>";
        }
        return $output;
    }
}
