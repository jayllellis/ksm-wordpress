<?php
/*--------------------------------------------------------------
*  Theme Setup
--------------------------------------------------------------*/
if ( ! function_exists( 'ar_theme_setup' ) ) :

function ar_theme_setup(){

  // Register Menus
  if ( function_exists( 'register_nav_menus' ) ) {
    register_nav_menus( array(
      'main-nav' => __( 'Main Menu', 'ar' ),
      'footer-nav' => __( 'Footer Menu', 'ar' ),
	    'mobile-nav' => __( 'Mobile Menu', 'ar' )
    ) );
  }

  // Add support for auto-generated title tag
  // add_theme_support( 'title-tag' );
  // Add support for custom logo
  add_theme_support( 'custom-logo' );
  // Add support for featured images
  add_theme_support( 'post-thumbnails' );

  // Set the default attachments 'link to' option to 'None'
  update_option('image_default_link_type', 'none' );

  if ( ! isset( $content_width ) ) {
    $content_width = 1000;
  }

}

endif;
add_action('after_setup_theme', 'ar_theme_setup');

/*--------------------------------------------------------------
 *  Make WordPress a little more secure and a lot
 *  cleaner by removing a few links in the <head>
 --------------------------------------------------------------*/
 function ar_head_cleanup() {

  remove_action('wp_head', 'rsd_link');
  // remove_action('wp_head', 'wp_generator'); //removes WP Version # for security
  remove_action('wp_head', 'feed_links', 2);
  remove_action('wp_head', 'index_rel_link');
  remove_action('wp_head', 'wlwmanifest_link');
  remove_action('wp_head', 'feed_links_extra', 3);
  remove_action('wp_head', 'start_post_rel_link', 10, 0);
  remove_action('wp_head', 'parent_post_rel_link', 10, 0);
  remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0);
  remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0 );
  remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );
     
}
add_action('init', 'ar_head_cleanup');

function ar_remove_version() {
  return '';
}
add_filter('the_generator', 'ar_remove_version');

/*--------------------------------------------------------------
 *  Enqueue scripts
 --------------------------------------------------------------*/
 function ksm_scripts(){
  
  // wp_register_script('recaptcha', 'https://www.google.com/recaptcha/api.js', false, THEME_VERSION, false);

  // wp_register_script('vendor-scripts', get_template_directory_uri() . '/assets/js/vendor-scripts.js', array('jquery'), THEME_VERSION, true);
  wp_enqueue_script('gsap', get_template_directory_uri() . '/assets/js/vendor/gsap.min.js', array(), THEME_VERSION, true);
  wp_enqueue_script('scroll-trigger', get_template_directory_uri() . '/assets/js/vendor/ScrollTrigger.min.js', array(), THEME_VERSION, true);
  wp_enqueue_script('custom-scripts', get_template_directory_uri() . '/assets/js/bundle.min.js', array('gsap', 'scroll-trigger'), THEME_VERSION, true);

  wp_localize_script('custom-scripts', 'KSM_DATA', array(
    'ID' => get_the_ID(),
    'site_url' => get_site_url(),
    'theme_url' => get_template_directory_uri(),
  ));

  // wp_enqueue_script('vendor-scripts');
  // wp_enqueue_script('custom-scripts');

}
add_action( 'wp_enqueue_scripts', 'ksm_scripts' );

/*--------------------------------------------------------------
 *  Enqueue styles
 --------------------------------------------------------------*/
 function ksm_styles(){

  // CSS Stylesheets
  wp_enqueue_style('default-styles', get_template_directory_uri().'/assets/css/styles.min.css', array(), THEME_VERSION);// default styles

}
add_action( 'wp_enqueue_scripts', 'ksm_styles' );

/*--------------------------------------------------------------
* Custom login
--------------------------------------------------------------*/
include('_custom-login.php');

/*--------------------------------------------------------------
* Hide WP editor on page edit screen
--------------------------------------------------------------*/
add_action( 'admin_init', 'hide_editor' );
function hide_editor() {
  global $pagenow;
  if (( $pagenow == 'post.php' || $pagenow == 'post-new.php' ) || (get_post_type() == 'page')) {
    remove_post_type_support('page', 'editor');
  }
}

/*--------------------------------------------------------------
* Create Theme Options Section
--------------------------------------------------------------*/
if( function_exists('acf_add_options_page') ) {
	
	acf_add_options_page(array(
		'page_title' 	=> 'Global Settings',
		'menu_title'	=> 'Global Settings',
		'menu_slug' 	=> 'global-settings',
	));
	
}

/*--------------------------------------------------------------
* Get menu items
--------------------------------------------------------------*/
function get_menu_items($menu_slug = 'main-nav') {
  $locations = get_nav_menu_locations();
  $menu = wp_get_nav_menu_object( $locations[ $menu_slug ] );
  $menuitems = wp_get_nav_menu_items( $menu->term_id, array( 'order' => 'DESC' ) );

  $menu_object = [];

  foreach($menuitems as $menu_item) {
    if( $menu_item->object_id ) {
      $slug = get_post_field( 'post_name', $menu_item->object_id );
      $menu_item->slug = $slug;
    }
    $menu_object[] = $menu_item;
  }

  return $menu_object;
}

/*--------------------------------------------------------------
* Create unique IDs for ACF Flexible Content layouts
--------------------------------------------------------------*/
add_action('acf/save_post', 'my_acf_save_post');
function my_acf_save_post( $post_id ) {

    // Get newly saved values.
    // $values = get_fields( $post_id );
    if( have_rows('page_content', $post_id) ):

      while ( have_rows('page_content', $post_id) ) : the_row();
  
        // Check the new value of a specific field.
        $component_id = get_sub_field('component_id');
        if( !$component_id ) {
          update_sub_field('component_id', uniqid('component-'), $post_id);
        }
          
      endwhile;
    endif;
}

/*--------------------------------------------------------------
* Add custom styles to admin area
--------------------------------------------------------------*/
add_action('admin_head', 'ksm_admin_styles');

function ksm_admin_styles() {
  echo '<style>
    div[data-name="component_id"] {
      display: none;
    } 
  </style>';
}