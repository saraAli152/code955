<?php require_once('assets.php');
 function img_features() {
    add_theme_support('post-thumbnails' );
   
  }
  
  // Hook to the init action hook, run our navigation menu function
  
  add_action( 'after_setup_theme', 'img_features' );
  add_theme_support( 'post-thumbnails' );
  add_theme_support( 'custom-background' );
  add_theme_support( 'custom-logo' );
  add_theme_support( 'title-tag' );
  add_theme_support( 'custom-header' );
 
 
if ( ! file_exists( get_template_directory() . '/inc/class-wp-bootstrap-navwalker.php' ) ) {
  // File does not exist... return an error.
  return new WP_Error( 'class-wp-bootstrap-navwalker-missing', __( 'It appears the class-wp-bootstrap-navwalker.php file may be missing.', 'wp-bootstrap-navwalker' ) );
} else {
  // File exists... require it.
  require_once get_template_directory() . '/inc/class-wp-bootstrap-navwalker.php';
}
// Hide core sections/controls when they aren't used on the current page.

