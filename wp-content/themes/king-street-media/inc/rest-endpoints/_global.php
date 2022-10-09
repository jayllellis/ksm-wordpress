<?php
add_action( 'rest_api_init', function () {
  register_rest_route( 'v1', 'global/get', array(
		'methods' => 'GET',
		'callback' => 'ksm_get_global',
  ) );
} );

function ksm_get_global() {
	$main_menu = get_menu_items('main-nav');
	$newsletter_contact = get_field('newsletter_and_contact_tile', 'option');
	$site_settings = get_field('site_settings', 'option');
	
	$site_logo = wp_get_attachment_image_src( $site_settings['logo'], 'full' );

	// NEWSLETTER LOGO
	$newsletter_contact_logo = wp_get_attachment_image_src( $newsletter_contact['logo'], 'full' );
	$newsletter_contact['logo'] = $newsletter_contact_logo;

  	return [
		'site_logo_url' => $site_logo[0],
		'main_menu' => $main_menu,
		'newsletter_contact' => $newsletter_contact,
	];
}
