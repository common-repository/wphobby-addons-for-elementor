<?php
/**
 * WHAE Class
 *
 * @author  WPHobby
 * @package WPHobby Addons For Elementor
 * @version 1.0.0
 */
class WHAE {

    /**
     * options
     *
     * @var string
     */
    public $options;

    public function __construct() {
        $this->options = get_option(WHAE_OPTIONS);

        /* Enqueue Style and Scripts */
        add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_styles_scripts' ) );

        // Register custom category
        add_action( 'elementor/elements/categories_registered', array( $this, 'add_category' ) );

        // Register Elementor Widgets
        add_action( 'elementor/widgets/widgets_registered', array( $this, 'register_widgets' ) );

        // Placeholder image replacement
        add_filter( 'elementor/utils/get_placeholder_image_src', array( $this, 'set_placeholder_image' ) );

        add_action( 'elementor/frontend/after_register_scripts', array( $this, 'register_fronted_scripts' ) );

        // Edit and preview enqueue
        add_action( 'elementor/preview/enqueue_styles', array( $this, 'enqueue_preview_style' ) );


    }

    public function activate(){
        //plugin default opts
        $init_opts = array(
            'version' => WHAE_VERSION
        );

        if(!empty($this->options)){
            // update existed options
            update_option(WHAE_OPTIONS, $init_opts);
        }else{
            // add the init options
            add_option(WHAE_OPTIONS, $init_opts);
        }

        // Redirect to plugin admin main page
        wp_redirect( admin_url("admin.php?page=whae-panel") );
    }

    public function initialize(){
    }

    public function deactivate(){
    }

    /**
     * Enqueue Styles and Scripts
     */
    public function enqueue_styles_scripts() {
        wp_enqueue_style('font-awesome', WHAE_URL . 'assets/css/font-awesome.min.css', false, WHAE_VERSION );
        wp_enqueue_style('flaticon', WHAE_URL . 'assets/css/flaticon.css', false, WHAE_VERSION );
        wp_enqueue_style('whae-widgets', WHAE_URL . 'assets/css/whae-widgets.css', false, WHAE_VERSION);
        wp_enqueue_style('whae-slick', WHAE_URL . 'assets/vendor/slick/slick.css', false, WHAE_VERSION);
        wp_enqueue_style('whae-slick-theme', WHAE_URL . 'assets/vendor/slick/slick-theme.css', false, WHAE_VERSION);
        wp_enqueue_style('justified-gallery-css', WHAE_URL . 'assets/vendor/justifiedGallery/css/justifiedGallery.min.css', false, WHAE_VERSION);


        wp_enqueue_script( 'whae-main', WHAE_URL . 'assets/js/main.js', array( 'jquery' ), WHAE_VERSION, true );
        wp_enqueue_script( 'whae-jquery-slick', WHAE_URL . 'assets/vendor/slick/slick.min.js', array( 'jquery' ), WHAE_VERSION, true );
        wp_enqueue_script( 'whae-jquery-justified-gallery', WHAE_URL . 'assets/vendor/justifiedGallery/js/jquery.justifiedGallery.min.js', array( 'jquery' ), WHAE_VERSION, true );

    }

    // Register frontend script
    public function register_fronted_scripts(){

        wp_register_script(
            'jquery-justifiedGallery',
            WHAE_URL . 'assets/vendor/justifiedGallery/js/jquery.justifiedGallery.min.js',
            array('jquery'),
            WHAE_VERSION,
            true
        );

    }

    // Add Widgets controller
    public function register_widgets() {
        // Include Widget files
        require_once( WHAE_DIR . 'includes/whae_widgets_control.php' );
    }

    // Add custom category
    public function add_category( $elements_manager ) {
        $elements_manager->add_category(
            'wphobby-addons-for-elementor',
            [
                'title' => __( 'WPHobby Addons', 'wphobby-addons-for-elementor' ),
                'icon' => 'fa fa-snowflake',
            ]
        );
    }

    public function set_placeholder_image() {
        return WHAE_URL . 'assets/images/placeholder.jpg';
    }

    public static function enqueue_preview_style() {

        if (whae_is_wpforms_activated() && defined('WPFORMS_PLUGIN_SLUG')) {
            wp_enqueue_style(
                'whae-wpform-preview',
                plugins_url('/' . WPFORMS_PLUGIN_SLUG . '/assets/css/wpforms-full.css', WPFORMS_PLUGIN_SLUG),
                null,
                WHAE_VERSION
            );
        }

    }
}
?>