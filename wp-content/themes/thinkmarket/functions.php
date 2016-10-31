<?php
add_action('after_setup_theme', 'after_setup_theme');
if (!function_exists('after_setup_theme')) {

  function after_setup_theme() {

    // Add default posts and comments RSS feed links to head.
    add_theme_support('automatic-feed-links');
    // Pour le document title
    add_theme_support('title-tag');
    // Enable support for Post Thumbnails on posts and pages.
    add_theme_support('post-thumbnails');
    // Hide admin bar in FO
    if (!current_user_can('administrator')) {
      show_admin_bar(FALSE);
    }
    // Remove meta generator
    remove_action('wp_head', 'wp_generator');

    require_once(get_stylesheet_directory() . '/inc/custom-types.php');
    require_once(get_stylesheet_directory() . '/inc/class/CFunctions.class.php');

    register_nav_menus(array(
      'primary' => 'Menu principale',
    ));

    add_image_size('thumbnail', 300, 300, TRUE); // A modifier

  }
} // after_setup_theme