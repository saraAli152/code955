<?php
function add_normalize_CSS() {
	wp_enqueue_style( 'normalize-styles', "https://cdnjs.cloudflare.com/ajax/libs/normalize/7.0.0/normalize.min.css");
 }
 add_action('wp_enqueue_scripts', 'add_normalize_CSS');



function addstyle1() {
    wp_enqueue_style('bootstrap',get_template_directory_uri().'/assets/css/bootstrap.min.css');
    wp_enqueue_style('style',get_template_directory_uri().'/style.css');
  }
  // Hook to the init action hook, run our navigation menu function
  add_action( 'wp_enqueue_scripts', 'addstyle1' );

  function addscript1() {
    wp_enqueue_script('bootstrap',get_template_directory_uri().'/assets/js/bootstrap.bundle.js','', '',true );
   
  }
  // Hook to the init action hook, run our navigation menu function
  add_action( 'wp_enqueue_scripts', 'addscript1' );
  

  function themename_custom_logo_setup() {
    $defaults = array(
      'height'               => 100,
      'width'                => 400,
      'flex-height'          => true,
      'flex-width'           => true,
      'header-text'          => array( 'site-title', 'site-description' ),
      'unlink-homepage-logo' => true, 
    );
    add_theme_support( 'custom-logo', $defaults );
  }
  add_action( 'after_setup_theme', 'themename_custom_logo_setup' );
  function themename_custom_header_setup() {
    $args = array(
      'default-image'      => get_template_directory_uri() . 'img/default-image.jpg',
      'default-text-color' => '000',
      'width'              => 1000,
      'height'             => 250,
      'flex-width'         => true,
      'flex-height'        => true,
    );
    add_theme_support( 'custom-header', $args );
  }
  add_action( 'after_setup_theme', 'themename_custom_header_setup' );

  $another_args = array(
    'default-image'      =>get_template_directory_uri(). '/images/hero_1.png',
    'default-position-x' => 'right',
    'default-position-y' => 'top',
    'default-size'     => 'cover',
    'default-repeat'     => 'no-repeat',
);
add_theme_support( 'custom-background', $another_args );
function register_my_menus() {
  register_nav_menus(
    array(
      'header-menu' => __( 'Header Menu' ),
      'footer-menu' => __( 'footer Menu' )
     )
   );
 }
 add_action( 'init', 'register_my_menus' );
 class wp_dropdown_menu extends Walker_Nav_menu
 {
   private $current_item;
   private $dropdown_menu_alignment_values = [
     'dropdown-menu-start',
     'dropdown-menu-end',
     'dropdown-menu-sm-start',
     'dropdown-menu-sm-end',
     'dropdown-menu-md-start',
     'dropdown-menu-md-end',
     'dropdown-menu-lg-start',
     'dropdown-menu-lg-end',
     'dropdown-menu-xl-start',
     'dropdown-menu-xl-end',
     'dropdown-menu-xxl-start',
     'dropdown-menu-xxl-end'
   ];
 
   function start_lvl(&$output, $depth = 0, $args = null)
   {
     $dropdown_menu_class[] = '';
     foreach($this->current_item->classes as $class) {
       if(in_array($class, $this->dropdown_menu_alignment_values)) {
         $dropdown_menu_class[] = $class;
       }
     }
     $indent = str_repeat("\t", $depth);
     $submenu = ($depth > 0) ? ' sub-menu' : '';
     $output .= "\n$indent<ul class=\"dropdown-menu$submenu " . esc_attr(implode(" ",$dropdown_menu_class)) . " depth_$depth\">\n";
   }
 
   function start_el(&$output, $item, $depth = 0, $args = null, $id = 0)
   {
     $this->current_item = $item;
 
     $indent = ($depth) ? str_repeat("\t", $depth) : '';
 
     $li_attributes = '';
     $class_names = $value = '';
 
     $classes = empty($item->classes) ? array() : (array) $item->classes;
 
     $classes[] = ($args->walker->has_children) ? 'dropdown' : '';
     $classes[] = 'nav-item';
     $classes[] = 'nav-item-' . $item->ID;
     if ($depth && $args->walker->has_children) {
       $classes[] = 'dropdown-menu dropdown-menu-end';
     }
 
     $class_names =  join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args));
     $class_names = ' class="' . esc_attr($class_names) . '"';
 
     $id = apply_filters('nav_menu_item_id', 'menu-item-' . $item->ID, $item, $args);
     $id = strlen($id) ? ' id="' . esc_attr($id) . '"' : '';
 
     $output .= $indent . '<li ' . $id . $value . $class_names . $li_attributes . '>';
 
     $attributes = !empty($item->attr_title) ? ' title="' . esc_attr($item->attr_title) . '"' : '';
     $attributes .= !empty($item->target) ? ' target="' . esc_attr($item->target) . '"' : '';
     $attributes .= !empty($item->xfn) ? ' rel="' . esc_attr($item->xfn) . '"' : '';
     $attributes .= !empty($item->url) ? ' href="' . esc_attr($item->url) . '"' : '';
 
     $active_class = ($item->current || $item->current_item_ancestor || in_array("current_page_parent", $item->classes, true) || in_array("current-post-ancestor", $item->classes, true)) ? 'active' : '';
     $nav_link_class = ( $depth > 0 ) ? 'dropdown-item ' : 'nav-link ';
     $attributes .= ( $args->walker->has_children ) ? ' class="'. $nav_link_class . $active_class . ' dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"' : ' class="'. $nav_link_class . $active_class . '"';
 
     $item_output = $args->before;
     $item_output .= '<a' . $attributes . '>';
     $item_output .= $args->link_before . apply_filters('the_title', $item->title, $item->ID) . $args->link_after;
     $item_output .= '</a>';
     $item_output .= $args->after;
 
     $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
   }
 }
 
 
 add_filter( 'nav_menu_link_attributes', 'dropdown_menu' );
function dropdown_menu( $atts ) {
     if ( array_key_exists( 'data-toggle', $atts ) ) {
         unset( $atts['data-toggle'] );
         $atts['data-bs-toggle'] = 'dropdown';
     }
     return $atts;
}
 

  