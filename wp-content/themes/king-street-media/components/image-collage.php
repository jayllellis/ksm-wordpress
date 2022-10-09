<?php
if( have_rows('images') ):
    $images = [];

    while( have_rows('images') ) : the_row();
        $images[] = wp_get_attachment_image_src( get_sub_field('image'), 'full' );
    endwhile;
endif;

$link = str_replace( home_url(), '', get_sub_field('link') );
?>

<section id="<?php the_sub_field('component_id'); ?>"></section>