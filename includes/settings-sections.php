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
 * The below functions are copy pasted from WordPress core and right now they are as it is
 * except name changings of functions. but we will modify these two functions
 * to get rid from default WordPress table layout in admin pages.
 *
 *@package WordPress
 **/

function annframe_do_settings_sections( $page ) {

  global $wp_settings_sections, $wp_settings_fields;

	if ( !isset( $wp_settings_sections[$page] ) )

    return;

	foreach ( (array) $wp_settings_sections[$page] as $section ) {

    if ( $section['title'] )

    	echo "<h2>{$section['title']}</h2>\n";

		if ( $section['callback'] )

      call_user_func( $section['callback'], $section );

		if ( ! isset( $wp_settings_fields ) || !isset( $wp_settings_fields[$page] ) || !isset( $wp_settings_fields[$page][$section['id']] ) )

      continue;

    echo '<table class="form-table">';

    annframe_do_settings_fields( $page, $section['id'] );

    echo '</table>';
	}
}

add_action( 'admin_init', 'annframe_do_settings_Sections' );

/**
 * Print out the settings fields for a particular settings section
 *
 * Part of the Settings API. Use this in a settings page to output
 * a specific section. Should normally be called by do_settings_sections()
 * rather than directly.
 *
 * @global $wp_settings_fields Storage array of settings fields and their pages/sections
 *
 * @since 2.7.0
 *
 * @param string $page Slug title of the admin page who's settings fields you want to show.
 * @param string $section Slug title of the settings section who's fields you want to show.
 */

 function annframe_do_settings_fields($page, $section) {

   global $wp_settings_fields;

	if ( ! isset( $wp_settings_fields[$page][$section] ) )

    return;

	foreach ( (array) $wp_settings_fields[$page][$section] as $field ) {

    $class = '';

		if ( ! empty( $field['args']['class'] ) ) {

      $class = ' class="' . esc_attr( $field['args']['class'] ) . '"';
		}

		echo "<tr{$class}>";

		if ( ! empty( $field['args']['label_for'] ) ) {

    	echo '<th scope="row"><label for="' . esc_attr( $field['args']['label_for'] ) . '">' . $field['title'] . '</label></th>';

    } else {

      echo '<th scope="row">' . $field['title'] . '</th>';
		}

		echo '<td>';

    call_user_func($field['callback'], $field['args']);

  	echo '</td>';

    echo '</tr>';
	}

}
?>
