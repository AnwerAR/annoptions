<?php
/**
 * @var $args array
 *
 */
$name = AO_Input_Types::fieldName( $args['id'] );
$values = AO_Input_Types::fieldValue( $args['id'] );
if ( null == $args['choices'] ) return;
$checked = '';
?>
<div class="annoptions-fields type__<?php echo $args['type'] . '-wrapper '; ?>">
<select class="annoptions-fields type__<?php echo $args['type'] . '-wrapper '; ?>" name="<?php echo $name . '['. $count .']' ?>">


<?php
foreach ( $args['choices'] as $key => $value ) : $count++;

if( is_array( $values ) && in_array( $key, $values ) ) $checked = 'selected="selected"';
?>
<option value="<?php echo $key; ?>" <?php echo $checked; ?>><?php echo $key; ?></option>
    <!-- <input
      class="<?php echo $args['elass']; ?>"
      type='checkbox'
      name="<?php echo $name . '['. $count .']' ?>"
      value=<?php echo $key; ?>
      id="<?php echo $args['id'] . '['. $count .']'; ?>"
      <?php echo $checked; ?>
    >
    <label for="<?php echo $args['id'] . '['. $count .']'; ?>"><?php echo $value; ?></label><br> -->
<?php $checked = ''; endforeach; ?>
</select>
</div>
