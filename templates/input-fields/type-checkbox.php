<?php
/**
 * @param $field
 *
 */
//extract( $fields );
// @TODO more enhancement and simplicity needed here for end users to extend these templates in their own themes/plugins.
$field = $template_args;
$name = AO_Input_Types::fieldName( $field['id'] );
$values = AO_Input_Types::fieldValue( $field['id'] );
if ( null == $field['choices'] ) return;
$checked = '';
?>
<div class="annoptions-fields type__<?php echo $field['type'] . '-wrapper '; ?>">
<?php
foreach ( $field['choices'] as $key => $value ) : $count++;

  if( is_array( $values ) && in_array( $key, $values ) ) $checked = 'checked="checked"';
?>
    <input
      class="<?php echo $field['elass']; ?>"
      type='checkbox'
      name="<?php echo $name . '['. $count .']' ?>"
      value=<?php echo $key; ?>
      id="<?php echo $field['id'] . '['. $count .']'; ?>"
      <?php echo $checked; ?>
    >
    <label for="<?php echo $field['id'] . '['. $count .']'; ?>"><?php echo $value; ?></label><br>
<?php $checked = ''; endforeach; ?>


</div>
