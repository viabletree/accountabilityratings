<?php

/**
 * Plugin Name: WordPress Stripe Donation (Premium)
 * Plugin URI:		      http://wordpress.org/plugins/wp-stripe-donation/
 * Description: 	      Best Donation Plugin for WordPress allows you to collect donation or payment on your website via Stripe payment gateway method.
 * Version: 		        3.1.3
 * Update URI: https://api.freemius.com
 * Author: 			        HM Plugin
 * Author URI: 		      https://hmplugin.com
 * Requires at least:   5.2
 * Requires PHP:        7.2
 * Tested up to:        6.0.2
 * Text Domain:         wp-stripe-donation
 * Domain Path:         /languages/
 * License:             GPL-2.0+
 * License URI:         http://www.gnu.org/licenses/gpl-2.0.txt
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( function_exists('wsd_fs') ) {

  wsd_fs()->set_basename(true, __FILE__);

} else {

  if ( ! class_exists('Wpsd_Master') ) {

    global $wpdb;

    define('WPSD_PATH', plugin_dir_path(__FILE__));
    define('WPSD_ASSETS', plugins_url('/assets/', __FILE__));
    define('WPSD_LANG', plugins_url('/languages/', __FILE__));
    define('WPSD_SLUG', plugin_basename(__FILE__));
    define('WPSD_PRFX', 'wpsd_');
    define('WPSD_CLS_PRFX', 'cls-wpsd-');
    define('WPSD_TXT_DOMAIN', 'wp-stripe-donation');
    define('WPSD_VERSION', '3.1.3');
    define('WPSD_TABLE', $wpdb->prefix . 'wpsd_stripe_donation');

    require_once WPSD_PATH . "/lib/freemius-integrator.php";

    require_once WPSD_PATH . 'inc/' . WPSD_CLS_PRFX . 'master.php';
    $wpsd = new Wpsd_Master();
    register_activation_hook(__FILE__, array($wpsd, WPSD_PRFX . 'install_table'));
    $wpsd->wpsd_run();

    // Creating Thank You Page
    function wpsd_create_thank_you_page() {
      
      $thank_you_page   = 'Wpsd Thank You';
      $check_page_exist = get_page_by_title($thank_you_page , 'OBJECT', 'page');
      $post_content     = '<h1>' . __('Thank You For Your Donation') . '</h1>';
      $post_content     .= '<p>' . __('We have sent you an email with the donation information') . '</p>';
      if ( empty( $check_page_exist ) ) {
          wp_insert_post( array(
              'comment_status' => 'close',
              'ping_status'    => 'close',
              'post_author'    => 1,
              'post_title'     => ucwords($thank_you_page ),
              'post_name'      => sanitize_title($thank_you_page ),
              'post_status'    => 'publish',
              'post_content'   => $post_content,
              'post_type'      => 'page',
              'post_parent'    => ''
              )
          );
      }
    }
    add_action( 'init', 'wpsd_create_thank_you_page' );

    // Donate link to plugin description
    function wpsd_plugin_row_meta( $links, $file ) {

        if ( WPSD_SLUG === $file ) {
            $row_meta = array(
              'wpsd_donation'  => '<a href="' . esc_url( 'https://www.paypal.me/mhmrajib/' ) . '" target="_blank" aria-label="' . __( 'Donate us', 'wp-stripe-donation' ) . '" style="color:green; font-weight: bold;">' . __( 'Donate us', 'wp-stripe-donation' ) . '</a>'
            );
    
            return array_merge( $links, $row_meta );
        }
        return (array) $links;
    }
    add_filter( 'plugin_row_meta', 'wpsd_plugin_row_meta', 10, 2 );

  }

}