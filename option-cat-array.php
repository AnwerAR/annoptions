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
 *@package   annOptions
 *@author    Anwer Abdul Rehman
 *@since 1.0
 **/
// added another line of comment.

function annframe_opt_arr(){

	$textdomain = 'annframe';
	$ann_options = array(
					//Adding Administration menu defaults. simple access $ann_options['admin_menu']['...'];
					'admin_menu' => array(

									'page_title' 		=> 	'annframe Options',
									'menu_title' 		=> 	'annOptions',
									'page_cap'			=> 	'manage_options',
									'menu_slug'  		=> 	'annSettings',
									'callback_func' => 	'annframe_display_content',
									'icon_url' 			=> 	'../images/admin-icon.png',
									'menu_order' 		=> 	100,

									),

					// will use in register_setting() & settings_fields()
					'register_settings' => array(

									'settings_name'	=>	'annframe_registred_settings',

									),

					//Settings Sections.
					'sections'	=>	array(

							array(

								'title'			=>	'General Settings',
								'id'			=>	'general_settings',
								'desc'			=>	'The Desc for General Settings section.',
								'callback_func'	=>	'annframe_sec_general_setting',
								'css_class'		=>	$textdomain.'-sec-general-setting',
								),
								array(

								'title'			=>	'Layout Options',
								'id'			=>	'layout_options',
								'desc'			=>	'The Desc for Layout Options section.',
								'callback_func'	=>	'annframe_sec_layout_opts',
								'css_class'		=>	$textdomain.'-sec-layout-opts',
								),
								array(

								'title'			=>	'Color Settings',
								'id'			=>	'color_settings',
								'desc'			=>	'The Desc for Color Settings section.',
								'callback_func'	=>	'annframe_sec_color_setting',
								'css_class'		=>	$textdomain.'-sec-color-setting',
								),

					),

					//Settings Fields.
					'settings_fields'	=>	array(

						array(

							'label' 		=>	'Favicon Text',
							'id' 				=>	'favicon_upload',
							'type' 			=>	'text',
							'desc' 			=>	'upload your site favison. preferred formats, png, jpeg, ico',
							'std'				=>	'http://facebook.com/favicon',
							'section'		=>	'general_settings',
							'menu_slug' => 	'annSettings',
							'callback'	=>	'annframe_favicon_callback',
						),
						array(

							'label' 	=>	'Logo Upload',
							'id' 		=>	'logo_upload',
							'type' 		=>	'upload',
							'desc' 		=>	'upload your site Logo. preferred formats, png, jpeg',
							'std'		=>	'annframe',
							'section'	=>	'general_settings',
							'menu_slug' => 	'annSettings',
							'callback'	=>	'annframe_logo_callback',
						),
						array(

							'label' 	=>	'Facebook Url',
							'id' 		=>	'facebook_url',
							'type' 		=>	'text',
							'desc' 		=>	'Enter Your Facebook URL',
							'std'		=>	'http://facebook.com/anwerabdurrehman',
							'section'	=>	'general_settings',
							'menu_slug' => 	'annSettings',
							'callback'	=>	'annframe_fburl_callback',
						),
					),
	);

	return $ann_options;

}

?>
