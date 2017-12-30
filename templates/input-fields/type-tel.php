<?php
/**
 * @var $args array
 *
 */
$name = AO_Input_Types::fieldName( $args['id'] );
$value = AO_Input_Types::fieldValue( $args['id'], $args['default'] );

?>
<div class="annoptions-fields type__<?php echo $args['type'] . '-wrapper '; ?>">
  <?php if ( $args['label'] != '' ): ?>
    <label for="<?php echo $args['id']; ?>">
      <?php _e( $args['label'], 'annoptions' ); ?>
    </label>
  <?php endif; ?>
  <input
    id="<?php echo $args['id']; ?>"
    type="<?php echo $args['type']; ?>"
    name="<?php echo $name; ?>"
    value="<?php echo $value; ?>"
    placeholder="<?php echo $args['placeholder']; ?>"
    class="<?php echo $args['elass']; ?>"
    >
</div>
