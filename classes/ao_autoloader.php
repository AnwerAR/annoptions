<?php
class ao_autoloader {
    private static $_instance = null;
    private function __construct() {
        spl_autoload_register( array( $this, 'auto_load_classes' ) );
    }
    public static function _instance() {
      if ( !self::$_instance ) {
        self::$_instance  = new ao_autoloader();
      }
      return self::$_instance;
    }
    public function auto_load_classes( $class_name ) {
        if ( is_readable( plugin_dir_path(  __FILE__  ) . $class_name . '.php' ) )
        {
            include_once( plugin_dir_path(  __FILE__  ) . $class_name . '.php' );
        }
        return;
    }
}
ao_autoloader::_instance();
