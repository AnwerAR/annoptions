<?php

class AO_Admin_Registers {

  private $pages = null;
  private $sections = null;
  private $fields = null;

  public function __construct() {
    add_action( 'admin_init', array( $this, 'registerSettings' ) );
  }
  public function registerSettings() {
    register_setting( 'ao_settings', 'ao_options' );
  }
  public function pageInit( $pages = null ) {
    if ( null === $pages ) return;
    $this->pages = $pages;
    add_action( 'admin_menu', array( $this, 'registerMenuPage' ) );
  }
  public function registerMenuPage() {
    foreach ($this->pages as $page_key => $page ) {
      switch ( $page['type'] ) {
        case 'submenu':
        add_submenu_page(
            $page['parent'],
            $page['page_title'],
            $page['menu_title'],
            $page['cap'],
            $page['slug'],
            array( $this, 'addMenuPage' )
        );
        break;

        default:
        add_menu_page(
            $page['page_title'],
            $page['menu_title'],
            $page['cap'],
            $page['slug'],
            array( $this, 'addMenuPage' ),
            $page['icon'],
            $page['position']
        );
        break;
      }
    }
  }

  public function sectionInit( $sections = null ) {
    if ( null === $sections ) return;
    $this->sections = $sections;
    add_action('admin_init', array( $this, 'registerSections' ) );
  }

  public function registerSections() {
    foreach ($this->sections as $sectionKey => $section ) {
      add_settings_section(
        $section['id'],
        $section['title'],
         array( $this, 'displaySection' ),
        $section['page']
      );
    }
  }

  public function displaySection( $args ) {
    unset ( $args['callback'] );
   $description = $this->sections[ $args['id']]['desc'];
   if ( null != $description ) {
     echo "<p id='{$args['id']}' class='section-description'>". $description ."</p>";
   }
  }

  public function fieldInit( $fields = null ) {
    if ( null === $fields ) return;
    $this->fields = $fields;
    add_action('admin_init', array( $this, 'registerFields' ) );
  }

  public function registerFields() {
    foreach ($this->fields as $fieldKey => $field ) {
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
      /**
       * @TODO major changings expected here replacing classes with template files
       * gonna use {ao_get_template_part} function which is defined in include/helpers.php
       */
      if ( ! file_exists ( AO_DIR . 'templates/input-fields/type-' . $fields['type'] . '.php' ) ) {
        echo "Input type template does not exists. Please create one<br>";
        echo AO_DIR . 'templates/input-fields/type-' . $fields['type'] . '.php';
      }
      else {
        ao_get_template_part( AO_DIR . 'templates/input-fields/type-' . $fields['type'] . '.php', $fields );
      }


      // $class = 'AO_Input_Type_'.$fields['type'];
      // if ( class_exists( $class ) ) {
      //   new $class( $fields );
      // }
      // else {
      //   echo 'Class <code>'. $class .'</code> not exists';
      // }


  }


  public function addMenuPage() { ?>
    <div class="wrap">
      <h2><?php echo isset( $this->pages[$_GET['page']]['page_title'] ) ? $this->pages[$_GET['page']]['page_title'] : ''; ?></h2>
      <form method="post" action="options.php" class="aoptions-form">
        <?php
          settings_fields( 'ao_settings' );
          do_settings_sections( $_GET['page'] );
          submit_button();
        ?>
     </form>
    </div>
    <?php
  }
}
