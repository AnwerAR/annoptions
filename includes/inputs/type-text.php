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
 * This file will possibly replace input-fields.php file for add_settings_field callback functions.
 *
 *@package   annOptions
 *@author    Anwer Abdul Rehman
 *@since 		1.0
 **/



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

	?>
