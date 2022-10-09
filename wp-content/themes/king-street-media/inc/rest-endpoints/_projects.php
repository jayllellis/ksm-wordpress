<?php
add_action( 'rest_api_init', function () {
  register_rest_route( 'v1', 'projects/get', array(
		// 'methods' => 'GET, POST',
		'methods' => 'GET',
		'callback' => 'ksm_get_projects',
  ) );
} );

function ksm_get_projects() {
    $args = array(
        'post_type' => 'ksm_project',
        'post_status' => 'publish',
        'posts_per_page' => -1,
        'orderby' => 'title',
        'order' => 'ASC',
    );
      
    $the_query = new WP_Query( $args );

    $projects = [];
    
    if( $the_query->have_posts() ) : 
        while( $the_query->have_posts() ) : $the_query->the_post();

            $slug = get_post_field( 'post_name', get_the_ID() );

            $projects[] = [
                'id' => get_the_ID(),
                'slug' => $slug,
                'path' => "/projects/$slug",
                'title' => get_the_title(),
            ];

        endwhile;
    endif;

    return $projects;
}
