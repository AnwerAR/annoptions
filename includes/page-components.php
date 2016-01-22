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
 *@package annOptions
 *@version 1.0
 *@since 1.0
 **/

  function annframe_admin_components () {
		$annframe_options = annframe_opt_arr();




  register_setting( 'ann_sections' , 'annframedb_options' );

  //add_settings_section( 'general_settings', '', null, 'annSettings'  );

  foreach( $annframe_options['sections'] as $key ) {

    add_settings_section(
									$key['id'],
									$key['title'],
									null,
									'annSettings'
								);
  }

  foreach( $annframe_options['settings_fields'] as $key ) {


      switch($key['type']) {
        case 'text' :

					add_settings_field(
										$key['id'],
										$key['label'],
										'annframe_input_text_callback',
										'annSettings', 'general_settings',
										$key
									);

        break;
        case 'textarea' :
        	add_settings_field(
										$key['id'],
										$key['label'],
										'annframe_allinone',
										$key['menu_slug'],
										$key['section'],$key
									);
        break;
				case 'upload' :
        	add_settings_field(
										$key['id'],
										$key['label'],
										'annframe_allinone',
										$key['menu_slug'],
										$key['section'],$key
									);
        break;
				case 'checkbox' :
				add_settings_field(
									$key['id'],
									$key['label'],
									'annframe_allinone',
									$key['menu_slug'],
									$key['section'],$key
								);
				break;
				case 'radio' :
				add_settings_field(
									$key['id'],
									$key['label'],
									'annframe_allinone',
									$key['menu_slug'],
									$key['section'],$key
								);
			 break;
			 case 'select' :
			 add_settings_field(
									$key['id'],
									$key['label'],
									'annframe_allinone',
									$key['menu_slug'],
									$key['section'],$key
								);
			break;
}

  }
  }
  add_action( 'admin_init', 'annframe_admin_components' );

?>
