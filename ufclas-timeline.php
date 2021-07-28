<?php
/**
 * Plugin Name: UFCLAS - Post Event Timeline
 * Plugin URI:
 * Description: This plugin will list out posts/events in a timeline style
 * Version: 1.0
 * Author: Efren Vasquez
 * Author URI: https://mediaservices.clas.ufl.edu
 */

 // Path to the root of the plugin, used for including template files
define( 'UFCLAS_TIMELINE_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
require UFCLAS_TIMELINE_PLUGIN_DIR . 'admin/inc/acf.php';
require UFCLAS_TIMELINE_PLUGIN_DIR . 'public/shortcodes/shortcodes.php';


/*======================================

  Include public CSS file

=======================================*/
  function ufclasTimeline_public_style() {
      wp_enqueue_style('public-styles', plugin_dir_url(__FILE__).'public/css/styles.css');
      wp_enqueue_script( 'jquery' );
      wp_enqueue_script('scroll-reveal', 'https://cdn.jsdelivr.net/scrollreveal.js/3.3.1/scrollreveal.min.js', array(), null, true);
      wp_enqueue_script('public-script', plugin_dir_url(__FILE__).'public/js/scripts.js');


  }

  add_action('wp_enqueue_scripts', 'ufclasTimeline_public_style');


  /*==================================

  Create custom post templates for event

  ====================================*/

  function ufclasTimeline_post_template ($templates) {
      $templates['public/templates/single-event.php'] = 'Event Timeline';
      return $templates;
      }
  add_filter ('theme_post_templates', 'ufclasTimeline_post_template');


  /*==================================

  Create custom post templates for event

  ====================================*/
  function timeline_body_class( $c ) {

    global $post;

    if( isset($post->post_content) && has_shortcode( $post->post_content, 'ufclas-timeline' ) ) {
        $c[] = 'ufclas-timeline';
    }
    return $c;
}
add_filter( 'body_class', 'timeline_body_class' );
