<?php
add_action( 'rest_api_init', function () {
  register_rest_route( 'v1', 'projects/single', array(
		'methods' => 'GET',
		'callback' => 'ksm_get_project',
  ) );
} );

function ksm_get_project( WP_REST_Request $request ) {
    $slug = $request->get_param('slug');

    $args = array(
        'name' => $slug,
        'post_type' => 'ksm_project',
        'post_status' => 'publish',
        'numberposts' => 1,
    );
      
    $the_query = new WP_Query( $args );

    $project = [];
    
    if( $the_query->have_posts() ) : 
        while( $the_query->have_posts() ) : $the_query->the_post();

            if( have_rows('photos') ):
                $photos = [];

                while( have_rows('photos') ) : the_row();
                    $photo_info = wp_get_attachment_image_src( get_sub_field('photo'), 'full' );
                    $photo_info[] = wp_get_attachment_caption( get_sub_field('photo') );
                    $photos[] = $photo_info;
                endwhile;
            endif;

            $project = [
                'template' => get_field('template'),
                'logo' => ksm_custom_logo_url(),
                'title' => get_the_title(),
                'short_description' => get_field('short_description'),
                'description' => get_field('description'),
                'photos' => $photos,
                'featured_image_url' => has_post_thumbnail() ? get_the_post_thumbnail_url() : $photos[0][0],
                'video' => get_field('video'),
                'video_2' => get_field('video_2'),
                'accent_colour' => get_field('accent_colour'),
                'tags' => get_the_terms( get_the_ID(), 'project_tag' ),
                'next_project_link' => get_next_project_link( get_the_ID() ),
            ];
        endwhile;
    endif;

    return $project;
}

function get_next_project_link($post_id) {
    $args = array(
        'post_type' => 'ksm_project',
        'post_status' => 'publish',
        'posts_per_page' => -1,
        'orderby'  => 'post_date',
        'order'    => 'DESC'
    );
    $posts = get_posts($args);
    // get IDs of posts retrieved from get_posts
    $ids = array();
    foreach ($posts as $thepost) {
        $ids[] = $thepost->ID;
    }
    // get and echo previous and next post in the same category
    $this_index = array_search($post_id, $ids);

    if (array_key_exists($this_index + 1, $ids)) {
        $next_id = $ids[$this_index + 1];
    } else {
        $next_id = $ids[0];
    }

    $post_slug = get_post_field( 'post_name', $next_id );
    
    return "/$post_slug";
}
