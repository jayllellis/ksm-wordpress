<?php
add_action( 'rest_api_init', function () {
  register_rest_route( 'v1', 'menus/get', array(
		'methods' => 'GET',
		'callback' => 'ksm_get_menus',
  ) );
} );

function ksm_get_menus( WP_REST_Request $request ) {
  $main_menu = get_menu_items('main-nav');
  $footer_menu = get_menu_items('footer-nav');
  $mobile_menu = get_menu_items('mobile-nav');

  return [
    'main_menu' => $main_menu,
    'footer_menu' => $footer_menu,
    'mobile_menu' => $mobile_menu,
  ];
}
