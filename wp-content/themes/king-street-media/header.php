<!DOCTYPE html>
<!--[if IE 8]> <html class="no-js lt-ie9" lang="en" > <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" <?php language_attributes(); ?> > <!--<![endif]-->
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width" />
  <title>
		<?php
			/*
			 * Print the <title> tag based on what is being viewed.
			 */
			global $page, $paged;
			
			wp_title( '|', true, 'right' );
			bloginfo('name');
		?>
  </title>
  <meta name="description" content="Smart. Adaptive. Independent. A band of doers, thinkers and makers. Entrepreneurial to the core. Pros, from all walks of life. Who bring their unique perspective to your business challenge." />
  
  <?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>

<div class="bg-black font-sans text-white overflow-x-hidden">
	<div>

