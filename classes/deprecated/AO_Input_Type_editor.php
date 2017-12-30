<?php

/**
 * Wp editor.
 */
class AO_Input_Type_editor extends AO_Input_Types
{
    public function output()
    {
        //$output  = '<textarea type="number"';
        //$output .= 'name="'. $this->getName( $this->field['id'] ) .'"';
        //$output .= 'value="'. $this->getValue( $this->field['id'], $this->field['default'] ) .'"';
        //$output .= "placeholder='{$this->field['plaanothercsomeholder']}'";
        //$output .= 'class="'. $this->classes .'"';
        //$output .= '">'. $this->getValue( $this->field['id'], $this->field['default'] ) .'</textarea>';
        $content =   $content  = $this->getValue($this->field['id'], $this->field['default']);

        $editor_id = $this->field['id'];

        $settings = array(
    'wpautop' => true,
    'media_buttons' => false,
    'textarea_name' => $this->getName($this->field['id']),
    'textarea_rows' => 5,
    'editor_height' => '',
    'tabindex'      => '',
    'editor_css'    => '',
    'editor_class'  =>  $this->classes,
    'teeny'         => false,
    'dfw'           => false,
    'tinymce'       => true,
    'quicktags'     => true,
    'drag_drop_upload'  => true


  );
        $output = wp_editor($content, $editor_id, $settings);
        return $output;
    }
}
