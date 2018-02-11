<?php

class AO_Admin_Registers {

	private $pages    = null;
	private $sections = null;
	private $fields   = null;

	public function __construct() {
		add_action( 'admin_init', array( $this, 'registerSettings' ) );
	}
	public function registerSettings() {
		register_setting( 'AO_Manager', 'ao_options' );
	}
	public function pageInit( $pages = null ) {
		if ( null === $pages ) {
			return;
		}
		$this->pages = $pages;
		add_action( 'admin_menu', array( $this, 'registerMenuPage' ) );

		//print_r( $this->pages );
	}
	public function registerMenuPage() {
		foreach ( $this->pages as $page_key => $page ) {
			add_menu_page(
				$page->page_title,
				$page->menu_title,
				$page->capability,
				$page->slug,
				array( $this, 'addMenuPage' ),
				$page->icon,
				$page->position
			);
			// switch ( $page->type ) {
			// 	case 'submenu':
			// 		// add_submenu_page(
			// 		// 	$page->parent,
			// 		// 	$page->page_title,
			// 		// 	$page->menu_title,
			// 		// 	$page->capablity,
			// 		// 	$page->slug,
			// 		// 	array( $this, 'addMenuPage' )
			// 		// );
			// 		break;
            //
			// 	default:
			// 		// add_menu_page(
			// 		// 	$page['page_title'],
			// 		// 	$page['menu_title'],
			// 		// 	$page['cap'],
			// 		// 	$page['slug'],
			// 		// 	array( $this, 'addMenuPage' ),
			// 		// 	$page['icon'],
			// 		// 	$page['position']
			// 		// );
			// 		add_menu_page(
			// 			$page->page_title . 'Sadd',
			// 			$page->menu_title . 'Sadd',
			// 			$page->capablity,
			// 			$page->slug,
			// 			array( $this, 'addMenuPage' ),
			// 			$page->icon,
			// 			$page->position
			// 		);
			// 		break;
			// }
		}
	}

	public function sectionInit( $sections = null ) {
		if ( null === $sections ) {
			return;
		}
		$this->sections = $sections;
		add_action( 'admin_init', array( $this, 'registerSections' ) );
	}

	public function registerSections() {
		foreach ( $this->sections as $sectionKey => $section ) {
			add_settings_section(
				$section['id'],
				$section['title'],
				array( $this, 'displaySection' ),
				$section['page']
			);
		}
	}

	public function displaySection( $args ) {
		unset( $args['callback'] );
		$description = $this->sections[ $args['id'] ]['desc'];
		if ( null != $description ) {
			echo "<p id='{$args['id']}' class='section-description'>" . $description . '</p>';
		}
	}

	public function fieldInit( $fields = null ) {
		if ( null === $fields ) {
			return;
		}
		$this->fields = $fields;
		add_action( 'admin_init', array( $this, 'registerFields' ) );
	}

	public function registerFields() {
		foreach ( $this->fields as $fieldKey => $field ) {
			add_settings_field(
				$field['id'],
				$field['title'],
				array( $this, 'displayField' ),
				isset( $_GET['page'] ) ? $_GET['page'] : '',
				$field['section'],
				$field
			);
		}
	}

	public function displayField( $fields ) {

		if ( ! ao_template_exists( 'templates/input-fields', 'type-' . $fields['type'] ) ) {
			echo 'Input type template does not exists. Please create one<br>';
			echo '<strong>Missing: </code><code>' . AO_DIR . 'templates/input-fields/type-' . $fields['type'] . '.php</code>';
		} else {
			ao_get_template_part( 'templates/input-fields', 'type-' . $fields['type'], $fields );
		}
	}


	public function addMenuPage() {

		if ( ! ao_template_exists( 'templates', 'page' ) ) {
			echo 'Page template does not exists. Please create one<br>';
			echo '<strong>Missing: </code><code>' . AO_DIR . 'templates/page.php</code>';
		} else {
			ao_get_template_part( 'templates', 'page', $this->pages[ $_GET['page'] ] );
		}
	}
}
