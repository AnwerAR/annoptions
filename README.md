# annOptions
A flexible plugin to create WordPress admin panels on the go.
## Basic Usage
```
add_action ( 'ao_options', function ( $options ) {

  $options->setPage(
    'page_title' => __( 'Page Title' ),
    'menu_title' => __( 'Page Title' ),
    '....'       => '...'
  );
}
```
Documentation is coming soon.
