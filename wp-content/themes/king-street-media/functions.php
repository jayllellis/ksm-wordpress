<?php
define('THEME_VERSION', '1');
/**
 * Theme setup, enqueue scripts, etc.
 */
require get_template_directory() . '/inc/template-functions/theme-setup.php';

/**
 * Custom template tags for this theme
 */
require get_template_directory() . '/inc/template-tags/all-tags.php';

/**
 * Custom post types
 */
require get_template_directory() . '/inc/post-types/all-post-types.php';

/**
 * Custom WP REST endpoints
 */
require get_template_directory() . '/inc/rest-endpoints/all-endpoints.php';
