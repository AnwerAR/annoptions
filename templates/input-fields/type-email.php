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

?>
<div class="annoptions-fields type__<?php echo $field['type'] . '-wrapper '; ?>">
  <?php if ( $field['label'] != '' ): ?>
    <label for="<?php echo $field['id']; ?>">
      <?php _e( $field['label'], 'annoptions' ); ?>
    </label>
  <?php endif; ?>
  <input
    id="<?php echo $field['id']; ?>"
    type="<?php echo $field['type']; ?>"
    name="<?php echo $name; ?>"
    value="<?php echo $value; ?>"
    placeholder="<?php echo $field['placeholder']; ?>"
    class="<?php echo $field['elass']; ?>"
    >
</div>
