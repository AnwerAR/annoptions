<?php
/**
 * Display Page in Admin side.
 */
extract( $args ) ?>
<div class="wrap">
  <div id="<?php echo $slug . '-page'; ?>" class="annoptions_page <?php echo $slug . '-page'; ?>">
	<!-- Page title section -->
	<div class="ao-row">
	  <div class="ao_page_title ao-col-md-12">
		<h1><?php _e( $page_title, 'annoptions' ); ?></h1>
	  </div>
	</div>
	<!-- End of page title section -->
	<div class="ao-row">
	 <!-- Dummy datd for developmenat. -->
	  <!-- Left side of page containing menu -->
	  <div class="ao-col-md-3 letf-menu">
		<ul class="ao_left_menu">
		  <li><a href="#">Bonito</a></li>
		  <li><a href="#">Header Settings</a></li>
		  <li><a href="#">Body Setings</a></li>
		  <li><a href="#">Content Area</a></li>
		  <li><a href="#">Styles</a></li>
		  <li><a href="#">Scripts</a></li>
		  <li><a href="#">Export</a></li>
		  <li><a href="#">Footer</a></li>
		</ul>
	  </div>
	  <!-- End of menu wrapper -->

	  <!-- Content wrapper -->
	  <div class="ao-col-md-9 right-content">
		<form method="post" action="options.php" class="aoptions-form">
			<?php
			settings_fields( 'ao_settings' );
			do_settings_sections( $slug );
			submit_button();
			?>
	   </form>
	  </div>
	  <!-- End of content wrapper -->
	</div>
  </div>
</div>
