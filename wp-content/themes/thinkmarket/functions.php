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
    require_once(get_stylesheet_directory() . '/inc/class/COffre.class.php');

    register_nav_menus(array(
      'primary' => 'Menu principale',
      'mentions_menu' => "Menu Mentions",
      'footer_menu' => 'Menu Footer'
    ));

    add_image_size('thumbnail', 300, 300, TRUE); // A modifier
    add_image_size('portrait', 310, 310, TRUE); // A modifier


    function widgets_init() {
        register_sidebar( array(
            'name'          => __( 'feedtweet', 'thinkmarket' ),
            'id'            => 'feedtweet-widget',
            'description'   => __( 'Add widgets here to appear in your sidebar.', 'thinkmarket' )
        ) );
    }
    add_action( 'widgets_init', 'widgets_init' );

  }
} // after_setup_theme

add_filter('nav_menu_css_class' , 'special_nav_class' , 10 , 2);

function special_nav_class ($classes, $item) {
    if (in_array('current-menu-item', $classes) ){
        $classes[] = 'active ';
    }
    return $classes;
}
