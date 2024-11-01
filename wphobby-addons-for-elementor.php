<?php
/*
Plugin Name: WPHobby Addons For Elementor
Plugin URI: http://wphobby.com
Description: Ultimate addons package for Elementor page builder plugin for WordPress.
Version: 1.0.7
Author: wphobby
Author URI: https://wphobby.com/
*/

if ( ! defined( 'ABSPATH' ) ) {
   exit;
} // Exit if accessed directly

// Load plugin text domian
load_plugin_textdomain( 'wphobby-addons-for-elementor', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );

// Set constants
define('WHAE_DIR', plugin_dir_path(__FILE__));
define('WHAE_URL', plugin_dir_url(__FILE__));
define('WHAE_OPTIONS', 'whae_general_data');
define('WHAE_VERSION', '1.0.7');

if( ! function_exists( 'whae_check_elementor_admin_notice' ) ) {
   /**
    * Display an admin notice if elementor is not install or deactivated
    *
    * @since 1.0.0
    * @return string
    * @use admin_notices hooks
    */
   function whae_check_elementor_admin_notice() {
      // Check if elementor plugin installed
      $elementor = 'elementor/elementor.php';
      $installed_plugins_list = get_plugins();
      $plugins_active = isset( $installed_plugins_list[$elementor] );

      // Display admin notice messages
      if( $plugins_active ) {
         if( ! current_user_can( 'activate_plugins' ) ) { return; }

         $activation_url = wp_nonce_url( 'plugins.php?action=activate&amp;plugin=' . $elementor . '&amp;plugin_status=all&amp;paged=1&amp;s', 'activate-plugin_' . $elementor );

         $message = '<p>' . __( 'WPHobby Addons For Elementor is enabled but not effective. It requires you activate the Elementor plugin.', 'wphobby-addons-for-elementor' ) . '</p>';
         $message .= '<p>' . sprintf( '<a href="%s" class="button-primary">%s</a>', $activation_url, __( 'Activate Elementor Now', 'wphobby-addons-for-elementor' ) ) . '</p>';
      } else {
         if ( ! current_user_can( 'install_plugins' ) ) { return; }

         $install_url = wp_nonce_url( self_admin_url( 'update.php?action=install-plugin&plugin=elementor' ), 'install-plugin_elementor' );

         $message = '<p>' . __( 'WPHobby Addons For Elementor is enabled but not effective. It requires you install the Elementor plugin.', 'wphobby-addons-for-elementor' ) . '</p>';

         $message .= '<p>' . sprintf( '<a href="%s" class="button-primary">%s</a>', $install_url, __( 'Install Elementor Now', 'wphobby-addons-for-elementor' ) ) . '</p>';
      }
      echo '<div class="error"><p>' . $message . '</p></div>';
   }
}

if( ! function_exists( 'whae_install' ) ){
   function whae_install() {
       // Check if elementor plugin install and active
       if ( ! did_action( 'elementor/loaded' ) ) {
           add_action( 'admin_notices', 'whae_check_elementor_admin_notice' );
       }else{
           // Include files
           require_once('includes/whae_helper_function.php');
           require_once('includes/whae_init.php');
           require_once('includes/whae_admin.php');

           if ( ! function_exists('is_plugin_active')) {
               include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
           }

           // Initalize this plugin
           $WHAE = new WHAE();
           // When admin active this plugin
           register_activation_hook(__FILE__, array(&$WHAE, 'activate'));
           // When admin deactive this plugin
           register_deactivation_hook(__FILE__, array(&$WHAE, 'deactivate'));

           // Run the plugins initialization method
           add_action('init', array(&$WHAE, 'initialize'));
       }
   }
}

add_action( 'plugins_loaded', 'whae_install', 11 );
?>
