<?php

require_once('lib/setup-theme.php');
require_once('lib/custom-functions.php');
require_once('lib/setup-admin.php');
require_once('lib/setup-images.php');
require_once('lib/setup-acf.php');


/*
----------------
SETUP THEME
----------------
*/

add_action('after_setup_theme', 'setup_theme');


/*
----------------
CUSTOM IMAGE SIZES
----------------
*/

// Add custom image sizes
add_action('after_setup_theme', 'add_custom_image_sizes');

// Remove default WordPress image sizes
add_filter('intermediate_image_sizes_advanced', 'remove_default_image_sizes', 20);

// Disable scaled image size
add_filter('big_image_size_threshold', '__return_false');


/*
----------------
ACF
----------------
*/

add_action('acf/fields/flexible_content/layout_title', 'my_acf_flexible_content_layout_title', 10, 4);


/*
----------------
ADMIN UPDATES
----------------
*/

add_action('admin_menu', 'remove_admin_menus');
add_action('init', 'remove_comment_support', 100);
add_action('wp_before_admin_bar_render', 'remove_comments_admin_bar');
add_action('admin_init', 'remove_textarea');
add_action('init', 'remove_editor');
add_filter('show_admin_bar', '__return_false');


/*
----------------
ENQUEUE SCRIPTS/FILES
----------------
*/

add_action('wp_enqueue_scripts', function () {
  $dir = get_stylesheet_directory();
  $uri = get_stylesheet_directory_uri();

  $style_last_updated_at  = filemtime("$dir/dist/main.css");
  $script_last_updated_at = filemtime("$dir/dist/main.js");

  wp_enqueue_style('style', $uri . '/dist/main.css', array(), $style_last_updated_at);
  wp_enqueue_script('index', $uri . '/dist/main.js', array(), $script_last_updated_at);
});
