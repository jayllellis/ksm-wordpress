<?php
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
?>

<section id="<?php the_sub_field('component_id'); ?>"></section>