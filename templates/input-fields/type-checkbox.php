<?php
/**
 * @var $args array
 */
$name   = AO_Input_Types::fieldName( $args['id'] );
$values = AO_Input_Types::fieldValue( $args['id'] );
if ( null == $args['choices'] ) {
	return;
}
$checked = '';
?>
<div class="annoptions-fields type__<?php echo $args['type'] . '-wrapper '; ?>">
<?php
foreach ( $args['choices'] as $key => $value ) :
	$count++;

	if ( is_array( $values ) && in_array( $key, $values ) ) {
		$checked = 'checked="checked"';
	}
?>
	<input
	  class="<?php echo $args['elass']; ?>"
	  type='checkbox'
	  name="<?php echo $name . '[' . $count . ']'; ?>"
	  value=<?php echo $key; ?>
	  id="<?php echo $args['id'] . '[' . $count . ']'; ?>"
		<?php echo $checked; ?>
	>
	<label for="<?php echo $args['id'] . '[' . $count . ']'; ?>"><?php echo $value; ?></label><br>
<?php
$checked = '';
endforeach;
?>


</div>
