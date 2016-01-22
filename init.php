<?php

/**
 * Please consider this projecct as an assigment from new PHP & WordPress student
 * and forgive me for mistakes in my codes.
 *
 * This is initial commit and i am working to get this plugin on track
 * Contributions to this plugin is much more appreciated
 * because we togther can make something cool and ofcourse i will get
 * great things to learn from you.
 *
 * I am looking forward for your Contributions
 *
 *
 *
 *@package   OptionsCat
 *@author    Anwer Abdul Rehman
 *@version 1.0
 **/




	$theme_dir         = 	get_template_directory();
	$opt_cat_dir       = 	$theme_dir. '/options-cat';
	$includes_dir 		 =	$opt_cat_dir . '/includes';
	//$input_dir		   =	$includes.'/inputs';
	$options_array 	   = $includes_dir. '/option-cat-array.php';


    // This will load the options array and your filled values in $options_array goes here.

    //require_once ( $options_array );

	$files = array(

		'register-admin-page',
		'admin-page',
		'page-components',
    //'input-fields',
		'settings-sections',
		'option-cat-array'
    );

/*
*
  $input_types = array(

		'text',
		'upload',

	);
*
*/

	foreach( $files as $file ) {

		load_files( $includes_dir.'/'.$file.'.php' );
	}


	//foreach( $input_types as $inputs ) {

	//	load_files( $input_dir.'/type-'.$inputs.'.php' );
//	}




	function load_files( $file ) {

		include_once ( $file) ;
	}


  $annframe_options = annframe_opt_arr();

  $admin_menu = $annframe_options['admin_menu'];

  //Register Admin Menu and Page.

if(!is_admin()) { return null; } else {

    function annframe_admin_menu() {

      global $admin_menu;

        add_menu_page(

            $admin_menu['page_title'],
            $admin_menu['menu_title'],
            $admin_menu['page_cap'],
            $admin_menu['menu_slug'],
            $admin_menu['callback_func'],
            '',
            ''
          );
    }
}
add_action( 'admin_menu', 'annframe_admin_menu' );


  $annOptions = (array) get_option( 'annframedb_options' );

  function annframe_input_text_callback( $key ) {

    global $annOptions;
  	extract($key);
  	$value = null;

  if(isset($annOptions[$id]) && !empty($annOptions[$id])) {

  	$value = $annOptions[$id];

  }
  else {

  	$value = $std;

  }

  echo '<input id="'.$id.'" type="'.$type.'" name="annframedb_options['.$id.']" value="'.$value.'">';
  echo'<span class="desc">'. $desc .'</span>';

  }
  add_action('opt_cat_init', 'annframe_input_text_callback' );



  //this function will handle one of html input types and there are many more functions for input types to add.
  //in process of working.....

  function annframe_allinone($key) {
  global $settings_fields;

  echo $key['id'];
  }
?>
