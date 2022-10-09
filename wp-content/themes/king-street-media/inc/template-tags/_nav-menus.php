<?php
/*--------------------------------------------------------------
* Get main menu
--------------------------------------------------------------*/
function bwps_main_nav_menu(){
  wp_nav_menu(array(
    'container' => false, // remove nav container
    'container_class' => '', // class of container
    'menu_class' => 'menu menu--main', // class of menu
    'theme_location' => 'main-nav', // menu name
    'depth' => 2, // limit the depth of the nav
    'fallback_cb' => 'wp_page_menu', // fallback to a WP list of menu links
  ));
}

/*--------------------------------------------------------------
* Get footer menu
--------------------------------------------------------------*/
function bwps_footer_nav_menu(){
  wp_nav_menu(array(
    'container' => false, // remove nav container
    'container_class' => '', // class of container
    'menu_class' => 'menu menu--footer', // class of menu
    'theme_location' => 'footer-nav', // menu name
    'depth' => 2, // limit the depth of the nav
    'fallback_cb' => 'wp_page_menu', // fallback to a WP list of menu links
  ));
}

/*--------------------------------------------------------------
* Get mobile menu
--------------------------------------------------------------*/
function bwps_mobile_nav_menu() {
  wp_nav_menu(array(
    'container' => false, // remove nav container
    'container_class' => '', // class of container
    'menu_class' => 'menu menu--mobile', // class of menu
    'theme_location' => 'mobile-nav', // menu name
    'depth' => 3, // limit the depth of the nav
    'fallback_cb' => false, // fallback function (see below)
  ));
}
