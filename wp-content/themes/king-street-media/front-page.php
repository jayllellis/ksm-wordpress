<?php

get_header();

if ( have_posts() ) : while ( have_posts() ) : the_post();
				
	if( have_rows('page_content') ):

		while ( have_rows('page_content') ) : the_row();

			get_template_part('components/_components');
				
		endwhile;
	endif;
		
endwhile; endif;

get_footer();

?>
