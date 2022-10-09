<?php
function register_ksm_project_post_type() {
  $custom_post_type = 'ksm_project';
  $upp_plural_name = 'Case Studies';
  $upp_singular_name = 'Case Study';
  $low_plural_name = 'case studies';

  $labels = array(
    'name' => _x( $upp_plural_name, $custom_post_type ),
    'singular_name' => _x( $upp_singular_name, $custom_post_type ),
    'add_new' => _x( 'Add New', $custom_post_type ),
    'add_new_item' => _x( 'Add New '.$upp_singular_name, $custom_post_type ),
    'edit_item' => _x( 'Edit '.$upp_singular_name, $custom_post_type ),
    'new_item' => _x( 'New '.$upp_singular_name, $custom_post_type ),
    'view_item' => _x( 'View '.$upp_singular_name, $custom_post_type ),
    'search_items' => _x( 'Search '.$upp_plural_name, $custom_post_type ),
    'not_found' => _x( 'No '.$low_plural_name.' found', $custom_post_type ),
    'not_found_in_trash' => _x( 'No '.$low_plural_name.' found in Trash', $custom_post_type ),
    'parent_item_colon' => _x( 'Parent '.$upp_singular_name.':', $custom_post_type ),
    'menu_name' => _x( $upp_plural_name, $custom_post_type ),
  );

  $rewrite = array(
    'slug'                => $custom_post_type,
    'with_front'          => true,
    'pages'               => true,
    'feeds'               => true,
  );

  $args = array( 
    'labels' => $labels,
    'hierarchical' => false,
        
    'supports' => array( 'title', /*'editor', 'revisions', */ 'thumbnail', 'page-attributes' ),
    // 'taxonomies' => array( 'category' ),
    'public' => true,
    'show_ui' => true,
    'show_in_menu' => true,
    'menu_position' => 5,
    'menu_icon' => 'dashicons-open-folder', //https://developer.wordpress.org/resource/dashicons/
    'show_in_nav_menus' => true,
    'publicly_queryable' => true,
    'exclude_from_search' => false,
    'has_archive' => true,
    'query_var' => true,
    'can_export' => true,
    //'rewrite' => $rewrite,
    'capability_type' => 'post'
  );

  register_post_type( $custom_post_type, $args );
}

// Hook into the init action and call the function above when it fires
add_action( 'init', 'register_ksm_project_post_type' );


/*-------------------------------------------------------------------------------
  CUSTOM COLUMNS FOR HOME SLIDER
-------------------------------------------------------------------------------*/
/* add_filter( 'manage_edit-ksm_project_columns', 'edit_ksm_project_columns' ) ;

function edit_ksm_project_columns( $columns ) {

  $columns = array(
    'cb' => '<input type="checkbox" />',
    'project_thumb' => __( 'Thumbnail' ),
    'title' => __( 'Title' ),
    'date' => __( 'Date' ),
    'project_order' => __( 'Order' ),
  );

  return $columns;
}

add_action( 'manage_posts_custom_column', 'manage_ksm_project_columns', 10, 2 );

function manage_ksm_project_columns( $column, $post_id ) {
  global $post;

  switch( $column ) {

    case 'project_thumb' :
      // echo get_the_post_thumbnail($post_id, 'thumbnail');
      echo get_the_post_thumbnail($post_id, array( 100, 100));
    break;

    case 'project_order':
      $order = $post->menu_order;
      echo $order;
    break;

  }

} */

/* ---------------- SORT COLUMNS ---------------- */
/* add_filter( 'manage_edit-ksm_project_sortable_columns', 'ksm_project_sortable_columns' );

function ksm_project_sortable_columns( $columns ) {

  $columns['project_order'] = 'menu_order';

  return $columns;
} */

// Create a custom taxonomy & name it
function create_project_category_hierarchical_taxonomy() {
  // Variables
  $taxonomy_name = 'project_tag';
  $upp_plural_name = 'Tags';
  $upp_singular_name = 'Tag';
  $post_type = 'ksm_project';
  $plural_post_name = 'Projects';

  // Add new taxonomy, make it hierarchical like categories
  $labels = array(
    'name' => _x( $upp_plural_name, 'taxonomy general name' ),
    'singular_name' => _x( $upp_singular_name, 'taxonomy singular name' ),
    'search_items' =>  __( 'Search '.$upp_plural_name ),
    'all_items' => __( 'All '.$upp_plural_name ),
    'parent_item' => __( 'Parent '.$upp_singular_name ),
    'parent_item_colon' => __( 'Parent '.$upp_singular_name.':' ),
    'edit_item' => __( 'Edit '.$upp_singular_name ), 
    'update_item' => __( 'Update '.$upp_singular_name ),
    'add_new_item' => __( 'Add New '.$upp_singular_name ),
    'new_item_name' => __( 'New '.$upp_singular_name.' Name' ),
    'menu_name' => __( $upp_plural_name ),
  );    

  // Now register the taxonomy
  register_taxonomy($taxonomy_name, array($post_type), array(
    'hierarchical' => true,
    'labels' => $labels,
    'show_ui' => true,
    'show_admin_column' => true,
    'query_var' => true,
    'rewrite' => array( 'slug' => $taxonomy_name ),
  ));

}

// Hook into the init action and call the function above when it fires
add_action( 'init', 'create_project_category_hierarchical_taxonomy', 0 );
