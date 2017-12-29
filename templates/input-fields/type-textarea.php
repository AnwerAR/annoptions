<?php
/**
 * @param $field
 *
 */
//extract( $fields );
// @TODO more enhancement and simplicity needed here for end users to extend these templates in their own themes/plugins.
$field = $template_args;
$name = AO_Input_Types::fieldName( $field['id'] );
$value = AO_Input_Types::fieldValue( $field['id'], $field['default'] );
$classes = implode( $field['eclass'], ' ');
?>
<div class="annoptions-fields type__<?php echo $field['type'] . '-wrapper '; ?>">
  <textarea name="<?php echo $name; ?>" placeholder="<?php echo $field['placeholder']; ?>" class="<?php echo $classes; ?>"><?php echo $value; ?></textarea>
</div>
