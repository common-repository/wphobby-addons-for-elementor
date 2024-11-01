<?php
/**
 * WHAE Widgets Control Class
 *
 * @author  WPHobby
 * @package WPHobby Addons For Elementor
 * @version 1.0.0
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit;
} // Exit if accessed directly

class WHAE_Widgets_Control{

  public function __construct(){
     $this->whae_widgets_control();
  }

  // Control Widgets
  public function whae_widgets_control(){

    // Check on or off
    $banner = whae_get_option( 'banner', 'whae_save_settings', 'on' );
    $slider_box = whae_get_option( 'slider_box', 'whae_save_settings', 'on' );
    $post_grid = whae_get_option( 'post_grid', 'whae_save_settings', 'on' );
    $mailchimp = whae_get_option( 'mailchimp', 'whae_save_settings', 'on' );
    $wc_product_grid = whae_get_option( 'wc_product_grid', 'whae_save_settings', 'on' );


    $widgets_manager = \Elementor\Plugin::instance()->widgets_manager;

    if ( file_exists( WHAE_DIR.'includes/widgets/whae_banner.php' ) && $banner === 'on' ) {
         require_once WHAE_DIR.'includes/widgets/whae_banner.php';
         $widgets_manager->register_widget_type( new \Elementor\WHAE_Elementor_Widget_Banner() );
    }

    if ( file_exists( WHAE_DIR.'includes/widgets/whae_slider_box.php' ) && $slider_box === 'on' ) {
        require_once WHAE_DIR.'includes/widgets/whae_slider_box.php';
        $widgets_manager->register_widget_type( new \Elementor\WHAE_Elementor_Widget_Slider_Box() );
    }

    if ( file_exists( WHAE_DIR.'includes/widgets/whae_post_grid.php' ) && $post_grid === 'on' ) {
        require_once WHAE_DIR.'includes/widgets/whae_post_grid.php';
        $widgets_manager->register_widget_type( new \Elementor\WHAE_Elementor_Widget_Post_Grid() );
    }

   if ( file_exists( WHAE_DIR.'includes/widgets/whae_justified_gallery.php' ) ) {
        require_once WHAE_DIR.'includes/widgets/whae_justified_gallery.php';
        $widgets_manager->register_widget_type( new \Elementor\WHAE_Elementor_Justified_Gallery() );
   }

   if ( file_exists( WHAE_DIR.'includes/widgets/whae_wpform.php' ) ) {
        require_once WHAE_DIR.'includes/widgets/whae_wpform.php';
        $widgets_manager->register_widget_type( new \Elementor\WHAE_WPForm() );
   }

      if ( file_exists( WHAE_DIR.'includes/widgets/whae_info_box.php' ) ) {
          require_once WHAE_DIR.'includes/widgets/whae_info_box.php';
          $widgets_manager->register_widget_type( new \Elementor\WHAE_Info_Box() );
      }

      if ( file_exists( WHAE_DIR.'includes/widgets/whae_flip_box.php' ) ) {
          require_once WHAE_DIR.'includes/widgets/whae_flip_box.php';
          $widgets_manager->register_widget_type( new \Elementor\WHAE_Flip_Box() );
      }
      
    // Third party plugins addons
    if ( is_plugin_active('mailchimp-for-wp/mailchimp-for-wp.php') && file_exists( WHAE_DIR.'includes/widgets/whae_mailchimp.php' ) && $mailchimp === 'on') {
         require_once WHAE_DIR.'includes/widgets/whae_mailchimp.php';
         $widgets_manager->register_widget_type( new \Elementor\WHAE_Elementor_Widget_Mailchimp() );
    }

    if( is_plugin_active('woocommerce/woocommerce.php') && file_exists( WHAE_DIR.'includes/widgets/whae_wc_product_grid.php' ) && $wc_product_grid === 'on') {
         require_once WHAE_DIR.'includes/widgets/whae_wc_product_grid.php';
         $widgets_manager->register_widget_type( new \Elementor\WHAE_Elementor_Widget_WC_Product() );
    }  
  }        

}
new WHAE_Widgets_Control();