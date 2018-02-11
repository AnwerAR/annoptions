<?php
/**
 * Using for testing only
 * Used to test while development but eventually will be removed or modified.
 *
 * Register page.
 */



// ann_options()::Set('page')->addPage(
// 	array(
// 		'page_title' => 'annOptions',
// 		'menu_title' => 'annOptions',
// 		'cap'        => 'manage_options',
// 		'slug'       => 'annoptions',
// 		'type'       => 'menu',
// 		'parent'     => null,
// 		'icon'       => 'dashicons-admin-generic',
// 		'position'   => null,
// 		'desc'       => 'Lorem Ipsum',
// 		//'sections'   => null,
// 	)
// );

// annOptions::dummy( 'ddd_emoi' );
// //add_action( 'ao_options', 'ddd_emoi' );
//
// function ddd_emoi( $options ) {
//
// 	$options->addPage(
// 		array(
// 			'page_title' => __( 'somepage' ),
// 			'menu_title' => __( 'somepage' ),
// 			'slug'       => 'bonito-setupsss',
// 			'icon'       => 'dashicons-marker',
// 		)
// 	);
// }

// add_action( 'ao_options', 'ddd_emoiiii' );
//
// function ddd_emoiiii( $options ) {
//
// 	$options->addPage(
// 		array(
// 			'page_title' => __( '---Bonito sssSetup' ),
// 			'menu_title' => __( '---Bo sssSetup' ),
// 			'slug'       => 'bon---ito-setupsss',
// 			'icon'       => 'dashicons-marker',
// 		)
// 	);
// }

//add_action( 'init', array( 'AO_Manager', 'run' ), 5 );
// add_action(
// 	'ao_options', function ( $options ) {
// 		ann_options();
// 		$setPage = new AO_Admin_Registers();
// 		if ( null != $options->getPages() ) {
// 			$setPage->pageInit( $options->getPages() );
// 			add_action( 'admin_enqueue_scripts', 'ao_admin_print_scripts' );
// 		}
//
// 		if ( null != $options->getSections() ) {
// 			$setPage->sectionInit( $options->getSections() );
// 		}
//
// 		if ( null != $options->getFields() ) {
// 			$setPage->fieldInit( $options->getFields() );
// 		}
// 	}
// );



// require __DIR__ . '/classes/ao-manager.php';
// $panel[] = new AO_Panel(
// 	array('slug' => 'another-two', 'title' => 'Panel TWo'),
// 	'panel',
// 	'page'
// );
// $panel[] = new AO_Panel(
// 	array('ID' => 'panel-three', 'title' => 'Panel Three'),
// 	'panel',
// 	'page'
// );
// $panel[] = new AO_Panel(
// 	array('slug' => 'panel-four', 'title' => 'Panel Four', 'ID' => 'some'),
// 	'panel',
// 	'page'
// );
// echo "<pre>";
// print_r( $panel );
// echo "</pre>";


//AO_Manager::run();

add_action( 'ao_options', function( $options ){


	$options->addPage( array(
		'slug' => 'page-one',
		'menu_title'	=> 'Test Title',
		'type'	=> 'menu',
		'panels'	=> array(
			array('slug' => 'panel-four', 'title' => 'Panel Four', 'ID' => 'some'),
			array('slug' => 'panel-five', 'title' => 'Panel Five', 'ID' => 'someone'),
			array('slug' => 'panel-six', 'title' => 'Panel six', 'ID' => 'six')
		)
	));

	$options->addPage( array( 'slug' => 'testpaegtwo', 'menu_title'	=> 'Page Two', 'panels'	=> array(
		array('slug' => 'panel-four', 'title' => 'Panel Four', 'ID' => 'some'),
		array('slug' => 'panel-sevent', 'title' => 'Panel sevent', 'ID' => 'sevent'),
		array('slug' => 'panel-five', 'title' => 'Panel Five', 'ID' => 'someone'),
	) ) );

}, 1);


if ( null != ann_options()->page()->getPages() ) {
	$setPage = new AO_Admin_Registers();


	$setPage->pageInit( ann_options()->page()->getPages() );
	add_action( 'admin_enqueue_scripts', array( ann_options(), 'admin_scripts' ) );
}

// if ( null != ann_options()->pages()->getSections() ) {
// 	$setPage->sectionInit( ann_options()->pages()->getSections() );
// }
//
// if ( null != ann_options()->pages()->getFields() ) {
// 	$setPage->fieldInit( ann_options()->pages()->getFields() );
// }
//
// add_filter( 'ao_page_defaults', function( $args )  {
// 	$args['capability'] = 'manage_options';
// 	return $args;
// });
