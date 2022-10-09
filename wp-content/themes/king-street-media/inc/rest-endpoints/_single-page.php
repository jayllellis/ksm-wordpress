<?php
add_action( 'rest_api_init', function () {
  register_rest_route( 'v1', 'pages/single', array(
		'methods' => 'GET',
		'callback' => 'ksm_get_page',
  ) );
} );

function ksm_get_page( WP_REST_Request $request ) {
    $slug = $request->get_param('slug');

    $args = array(
        'name' => $slug,
        'post_type' => 'page',
        'post_status' => 'publish',
        'numberposts' => 1,
    );
      
    $the_query = new WP_Query( $args );

    $page = [];
    
    if( $the_query->have_posts() ) : 
        while( $the_query->have_posts() ) : $the_query->the_post();

            $rows = [];
            
            if( have_rows('page_content') ):

                while ( have_rows('page_content') ) : the_row();

                    switch ( get_row_layout() ) {
                        case 'all_work':
                            $rows[] = [
                                'content_type' => 'all_work',
                                'projects' => get_work_preview_items(-1),
                                'component_id' => get_sub_field('component_id'),
                            ];
                        break;

                        case 'callout_text':
                            $rows[] = [
                                'content_type' => 'callout_text',
                                'title' => get_sub_field('title'),
                                'description' => get_sub_field('description'),
                                'link' => get_sub_field('link'),
                                'component_id' => get_sub_field('component_id'),
                            ];
                        break;

                        case 'contact_form':
                            $contact_form = get_field('contact_form', 'option');

                            // $rows['newsletter_tile'] = [
                            $rows[] = [
                                'content_type' => 'contact_form',
                                'content' => $contact_form,
                                'component_id' => get_sub_field('component_id'),
                            ];
                        break;

                        case 'fullwidth_image':
                            $rows[] = [
                                'content_type' => 'fullwidth_image',
                                'image' => wp_get_attachment_image_src( get_sub_field('image'), 'full' ),
                                'component_id' => get_sub_field('component_id'),
                            ];
                        break;

                        case 'header_nav':
                            $rows[] = [
                                'content_type' => 'header_nav',
                                'component_id' => get_sub_field('component_id'),
                            ];
                        break;

                        case 'hero_section':
                            $rows[] = [
                                'content_type' => 'hero_section',
                                'hero_image' => wp_get_attachment_image_src( get_sub_field('hero_image'), 'full' ),
                                'logo' => wp_get_attachment_image_src( get_sub_field('logo'), 'full' ),
                                'component_id' => get_sub_field('component_id'),
                            ];
                        break;

                        case 'image_collage':
                            if( have_rows('images') ):
                                $images = [];

                                while( have_rows('images') ) : the_row();
                                    $images[] = wp_get_attachment_image_src( get_sub_field('image'), 'full' );
                                endwhile;
                            endif;

                            $rows[] = [
                                'content_type' => 'image_collage',
                                'images' => $images,
                                'link' => str_replace( home_url(), '', get_sub_field('link') ),
                                'component_id' => get_sub_field('component_id'),
                            ];
                        break;

                        case 'image_grid_carousel':
                            $blocks = [];

                            if( have_rows('image_grid') ):

                                while ( have_rows('image_grid') ) : the_row();
                            
                                    if( get_row_layout() == 'single_image' ):
                                        $single_image = wp_get_attachment_image_src( get_sub_field('image'), 'full' );
                                        $blocks[] = [
                                            'block_type' => 'single_image',
                                            'content' => $single_image,
                                        ];
                                    endif;
                            
                                    if( get_row_layout() == 'image_carousel' ): 
                                        if( have_rows('images') ):
                                            $block_content = [];
                                            $block_content['block_type'] = 'image_carousel';
                                            $block_content['content'] = [];

                                            while( have_rows('images') ) : the_row();
                                                $image = wp_get_attachment_image_src( get_sub_field('image'), 'full' );

                                                $block_content['content'][] = $image;
                                            endwhile;
                                        endif;

                                        $blocks[] = $block_content;
                                    endif;

                                    if( get_row_layout() == 'video' ): 
                                        $fallback_image = wp_get_attachment_image_src( get_sub_field('fallback_image'), 'full' );

                                        $blocks[] = [
                                            'block_type' => 'video',
                                            'content' => [
                                                'video_urls' => get_sub_field('video_files'),
                                                'fallback_image' => $fallback_image,
                                            ],
                                        ];
                                    endif;
                            
                                endwhile;
                            endif;

                            $rows[] = [
                                'content_type' => 'image_grid_carousel',
                                'blocks' => $blocks,
                                'component_id' => get_sub_field('component_id'),
                            ];
                        break;

                        case 'spacer':
                            $rows[] = [
                                'content_type' => 'spacer',
                                'background_colour' => get_sub_field('background_colour'),
                                'height' => (int) get_sub_field('height'),
                                'component_id' => get_sub_field('component_id'),
                            ];
                        break;

                        case 'team_tile':
                            if( have_rows('team_members') ):
                                $team_members = [];

                                while( have_rows('team_members') ) : the_row();
                                    $team_members[] = [
                                        'photo' => wp_get_attachment_image_src( get_sub_field('photo'), 'full' ),
                                        'name' => get_sub_field('name'),
                                        'role' => get_sub_field('role'),
                                    ];
                                endwhile;
                            endif;

                            $rows[] = [
                                'content_type' => 'team_tile',
                                'team_members' => $team_members,
                                'component_id' => get_sub_field('component_id'),
                            ];
                        break;

                        case 'text_with_image':
                            $rows[] = [
                                'content_type' => 'text_with_image',
                                'title' => get_sub_field('title'),
                                'description' => get_sub_field('description'),
                                'image' => wp_get_attachment_image_src( get_sub_field('image'), 'full' ),
                                'component_id' => get_sub_field('component_id'),
                            ];
                        break;

                        case 'two_column_list':
                            $rows[] = [
                                'content_type' => 'two_column_list',
                                'title' => get_sub_field('title'),
                                'list' => get_sub_field('list'),
                                'component_id' => get_sub_field('component_id'),
                            ];
                        break;

                        case 'two_column_text':
                            $rows[] = [
                                'content_type' => 'two_column_text',
                                'title' => get_sub_field('title'),
                                'description' => get_sub_field('description'),
                                'component_id' => get_sub_field('component_id'),
                            ];
                        break;
                        
                        case 'two_column_with_cta':
                            $rows[] = [
                                'content_type' => 'two_column_with_cta',
                                'column_1' => get_sub_field('column_1'),
                                'column_2' => get_sub_field('column_2'),
                                'cta' => get_sub_field('cta'),
                                'component_id' => get_sub_field('component_id'),
                            ];
                        break;

                        case 'work_preview':
                            $rows[] = [
                                'content_type' => 'work_preview',
                                'data' => get_work_preview_items(),
                                'component_id' => get_sub_field('component_id'),
                            ];
                        break;
                        
                    }
            
                endwhile;
            endif;

            $page = [
                'slug' => get_post_field( 'post_name', get_the_ID() ),
                'title' => get_the_title(),
                'page_content' => $rows,
            ];

        endwhile;
    endif;

    return $page;
}

function get_work_preview_items($posts_per_page = 5) {
    $args = array(
        'post_type' => 'ksm_project',
        'post_status' => 'publish',
        'posts_per_page' => $posts_per_page,
        'orderby' => 'post_date',
        'order' => 'DESC',
    );
      
    $the_query = new WP_Query( $args );

    $projects = [];
    
    if( $the_query->have_posts() ) : 
        
        $count = 0;

        while( $the_query->have_posts() ) : $the_query->the_post(); $count++;

            $slug = get_post_field( 'post_name', get_the_ID() );

            if($count % 1 == 0) {
                $container_size = '56-1';
            }
            if($count % 2 == 0) {
                $container_size = '44-1';
            }
            if($count % 3 == 0) {
                $container_size = '72';
            }
            if($count % 4 == 0) {
                $container_size = '44-2';
            }
            if($count % 5 == 0) {
                $container_size = '56-2';
            }

            if( have_rows('photos') ):
                $photos = [];

                while( have_rows('photos') ) : the_row();
                    $photos[] = wp_get_attachment_image_src( get_sub_field('photo'), 'full' );
                endwhile;
            endif;

            $project = [
                'title' => get_the_title(),
                'short_description' => get_field('short_description'),
                'description' => get_field('description'),
                'photos' => $photos,
                'featured_image_url' => has_post_thumbnail() ? get_the_post_thumbnail_url() : $photos[0][0],
                'tags' => get_the_terms( get_the_ID(), 'project_tag' ),
                'container_size' => $container_size,
            ];

            $projects[] = [
                'id' => get_the_ID(),
                'slug' => $slug,
                'path' => "/projects/$slug",
                'title' => get_the_title(),
                'content' => $project,
            ];

        endwhile;
    endif;

    wp_reset_postdata();

    return $projects;
}
