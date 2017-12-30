<?php
/**
 * @var $args array
 *
 */
$name = AO_Input_Types::fieldName( $args['id'] );
$value = AO_Input_Types::fieldValue( $args['id'], $args['default'] );
$classes = implode( $args['eclass'], ' ');
?>
<div class="annoptions-fields type__<?php echo $args['type'] . '-wrapper '; ?>">
  <textarea name="<?php echo $name; ?>" placeholder="<?php echo $args['placeholder']; ?>" class="<?php echo $classes; ?>"><?php echo $value; ?></textarea>
</div>
