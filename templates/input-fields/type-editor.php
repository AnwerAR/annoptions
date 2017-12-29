<?php
$field = $template_args;
$content = AO_Input_Types::fieldValue( $field['id'], $field['default'] );
$editor_id = $field['id'];

$settings = array(
  'wpautop' => true,
  'media_buttons' => false,
  'textarea_name' => AO_Input_Types::fieldName( $field['id'] ),
  'textarea_rows' => 5,
  'editor_height' => '',
  'tabindex'      => '',
  'editor_css'    => '',
  'editor_class'  => implode( $field['eclass'], ' ' ),
  'teeny'         => false,
  'dfw'           => false,
  'tinymce'       => true,
  'quicktags'     => true,
  'drag_drop_upload'  => true


);
$output = wp_editor( $content, $editor_id, $settings );
echo $output;
