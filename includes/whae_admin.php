<?php
/**
 * WHAE Admin Class
 *
 * @author  WPHobby
 * @package WPHobby Addons For Elementor
 * @version 1.0.0
 */
if( ! class_exists( 'WHAE_Admin' ) ) {
    class WHAE_Admin {
        // =============================================================================
        // Construct
        // =============================================================================
        public function __construct() {
            add_action( 'admin_init', array( $this, 'whae_register_settings' ) );
            add_action( 'admin_menu', array( $this, 'whae_register_menu' ) );
            add_action( 'admin_enqueue_scripts', array( $this, 'whae_admin_styles_scripts' ) );
            add_action( 'wp_ajax_whae_save_settings_ajax', array($this, 'whae_save_settings') );
        }

        /**
         * Load welcome admin css and js
         * @return void
         * @since  1.0.0
         */
        public function whae_admin_styles_scripts() {
            if ( is_admin() ) {
                wp_enqueue_style('font-awesome', WHAE_URL . 'assets/css/font-awesome.min.css', false, WHAE_VERSION);
                wp_enqueue_style('whae-admin-style', WHAE_URL . 'assets/css/admin.css', false, WHAE_VERSION);

                wp_enqueue_script( 'whae-admin-script', WHAE_URL . 'assets/js/admin.js', array( 'jquery' ), WHAE_VERSION, true );

                wp_localize_script('whae-admin-script', 'localize', array(
                    'ajaxurl' => admin_url('admin-ajax.php'),
                    'nonce' => wp_create_nonce('wphobby-addons-for-elementor'),
                ));
            }    
        }

        /**
         * Register admin menus
         * @return void
         * @since  1.0.0
         */
        public function whae_register_menu(){
            add_menu_page(
                __('WPHobby Addons For Elementor', 'wphobby-addons-for-elementor'),
                __('WPHobby', 'wphobby-addons-for-elementor'),
                'manage_options',
                'whae-panel',
                array( $this, 'whae_panel_general' ),
                'dashicons-admin-generic',
                '2'
            );
        }

        /**
         * The admin panel content
         * @since 1.0.0
         */
        public function whae_panel_general() {
            ?>
            <div class="whae-panel">
              <div class="wrap">
                  <h2 class="title"><?php esc_html_e('WPHobby Addons for Elementor Settings', 'wphobby-addons-for-elementor'); ?></h2>
                  <form action="" method="POST" id="whae-settings" name="whae-settings">
                    <div class="whae-settings-tabs">
                        <?php
                        require_once( WHAE_DIR . '/includes/admin/sections/general/top.php' );
                        require_once( WHAE_DIR . '/includes/admin/sections/general/tab-general.php' );
                        require_once( WHAE_DIR . '/includes/admin/sections/general/tab-elements.php' );
                        ?>
                    </div>
                </form>
              </div>
            </div>
            <div class="whae-notification-wrapper">
            </div>
            <?php
        }

        /**
         * Register Settings
         * @since 1.0.0
         */
        public function whae_register_settings() {
        }

        /**
         * Saving data with ajax request
         * @param
         * @return  array
         * @since 1.0.2
         */
        public function whae_save_settings()
        {
            check_ajax_referer('wphobby-addons-for-elementor', 'security');

            if (!isset($_POST['fields'])) {
                return;
            }

            parse_str($_POST['fields'], $elements);

            // update new settings
            $updated = update_option('whae_save_settings', $this->sanitize($elements));

            wp_send_json($updated);

            die;
        }

        /**
         * Return saved settings
         *
         * @since 1.0.2
         */
        public function get_settings($element = null, $default)
        {
            $elements = get_option('whae_save_settings');

            // return default if option not exists
            if(!$elements){
                return $default;
            }

            return isset($elements[$element]) ? $elements[$element] : 0;
        }

        /**
         * A custom sanitize function that will take the incoming input, and sanitize
         * the input before handing it back to WordPress to save to the database.
         *
         * @since    1.0.2
         *
         * @param    array    $input        The input array.
         * @return   array    $new_input    The sanitized input.
         */
        public function sanitize( $input ) {

            // Initialize the new array that will hold the sanitize values
            $new_input = array();

            // Loop through the input and sanitize each of the values
            foreach ( $input as $key => $val ) {
                $new_input[ $key ] = sanitize_text_field( $val );
            }

            return $new_input;

        }

    }

    new WHAE_Admin;
}