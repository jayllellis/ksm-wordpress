<?php
$title = get_sub_field('title');
$description = get_sub_field('description');
$image = wp_get_attachment_image_src( get_sub_field('image'), 'full' );
?>

<section id="<?php the_sub_field('component_id'); ?>"></section>