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
 * This file will contain add_menu_page callback function display everything on admin page.
 *
 *@package   OptionsCat
 *@author    Anwer Abdul Rehman
 *@since 1.0
 **/


function annframe_display_content() {

?>
<div class="wrap">
	<h2>annOptions</h2>
		<p>The Following Options will let you Enable the Changes we have made in Mukam.</p>

		<form method="post" action="options.php">
		<?php
				settings_fields('ann_sections');
				annframe_do_settings_sections('annSettings');
				submit_button();
				?>
		</form>
</div>

	 <?php
}

?>
