<?php
/**
 * Lorem ipsum dolor sit amet flang fistan.
 *
 * @since 1.0.0
 **/

class AO_Page_Manager {
	public $ID;
	public $title;
	public $other;

	public function __construct( $manager, $context, $args ) {

		$this->ID    = $args['ID'];
		$this->title = $args['title'];
		$this->other = $args['other'];
	}
}
