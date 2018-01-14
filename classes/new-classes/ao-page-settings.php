<?php
/**
 * AO_Page_Settings
 *
 * @package annOptions
 * @since   1.0.0
 */
class AO_Page_Settings
{

    /**
     * Page slug.
     *
     * @since 1.0.0
     * @var   string include only lowercase alphanumeric, dashes, and underscores characters
     */
    public $slug;

    /**
     * Page unique identifier (slug). will be generated from
     *
     * @since 1.0.0
     * @var   string
     */
    public $ID;

    /**
     * Page Title.
     *
     * @since 1.0.0
     * @var   string
     */
    public $page_title;

    /**
     * Menu title.
     *
     * @since 1.0.0
     * @var   string
     */
    public $menu_title = '';

    /**
     * Capablity.
     *
     * @since 1.0.0
     * @var   string
     */
    public $cap = 'manage_options';

    /**
     * Page icon.
     *
     * @since 1.0.0
     * @var   string
     */
    public $icon = 'dashicons-admin-settings';

    /**
     * Menu item Position.
     *
     * @since 1.0.0
     * @var   int accepts int, default is null
     */
    public $position = null;

    /**
     * Type of page .
     *
     * @since 1.0.0
     * @var   string allowed menu, submenu, post_page. default is menu
     */
    public $type = 'menu';

    /**
     * Description of page.
     *
     * @since 1.0.0
     * @var   string
     */
    public $description = '';

    /**
     * Sections of this page..
     *
     * @since 1.0.0
     * @var   array
     */
    public $sections = array();

    /**
     * Parent page unique identifier (slug).
     *
     * @since 1.0.0
     * @var   string default null
     */
    public $parent = null;

    /**
     * Errors.
     *
     * @since 1.0.0
     * @var   array default null
     */
    public $errors = array();

    /**
     * Class instance counter.
     *
     * @since 1.0.0
     * @var   int
     */
    public static $instance_counter = 0;

    /**
     * default args.
     *
     * @since  1.0.0
     * @param  array $args
     * @return array
     */
    private $args;

    /**
     * Constructor.
     *
     * @since  1.0.0
     * @param  array $args
     * @return object| WP_Error
     */
    public function __construct( $context = '',  $args )
    {
        $default_args = array(
        'page_title'  => '',
        'menu_title'  => '',
        'slug'        => null,
        'cap'         => $this->cap,
        'type'        => $this->type,
        'parent'      => null,
        'icon'        => $this->icon,
        'position'    => null,
        'description' => '',
        'sections'    => null,
        );
        $this->args   = wp_parse_args($args, $default_args);
        //$this->args = apply_filter( 'ao_' .$this->args['slug'] . '_page_init', $args );
        $this->pageArgs();
    }

    /**
     * Constructor.
     *
     * @since  1.0.0
     * @param  array $args
     * @return object| WP_Error
     */
    protected function pageArgs()
    {

        //Bail saftely if page slug (identifier) is not defined.
        if (null == $this->args['slug'] ) {
            return;
        }
        $this->args['ID'] = ao_html_unqid($this->args['slug'], 'page');
        //Bail saftely if page type is not defined.
        if (null == $this->args['type'] || '' == $this->args['type'] ) {
            return;
        }

        // One of param from Page or menu title is mandatory.
        if ('' == $this->args['page_title'] && '' == $this->args['menu_title'] ) {
            return;
        }
        // elseif( '' == $this->args['page_title'] || '' == $this->args['menu_title'] ) {
        //     $this->args['page_title'] = ( '' == $this->args['page_title']  ) ? $this->args['menu_title']  : $this->args['page_title'] ;
        // }

        if (null == $this->args['cap'] || '' == $this->args['cap'] ) {
            return;
        }

        if('submenu' == $this->args['type'] && null == $this->args['parent'] ) {
            $this->args['parent'] = 'settings.php';
        }

        // few more checks are expected here.

        $keys = array_keys(get_object_vars($this));
        foreach ( $keys as $key ) {
            if (isset($this->args[ $key ]) ) {
                    $this->$key = $this->args[ $key];
            }
        }

        unset($this->args);

    }

}
