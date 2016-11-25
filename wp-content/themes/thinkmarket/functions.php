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
    require_once(get_stylesheet_directory() . '/inc/class/CCustomEditor.class.php');
    require_once(get_stylesheet_directory() . '/inc/class/CActualite.class.php');
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

function wp_get_post_by_template( $meta_value )
{
  $args = array(
    'post_type' => 'page',
    'meta_key' => '_wp_page_template',
    'meta_value' => $meta_value,
    'suppress_filters' => FALSE,
    'numberposts' => 1,
    'fields' => 'ids'
  );
  $posts = get_posts($args);
  if(isset($posts) && !empty($posts)){
    return $posts[0];
  }else{
    global $post;
    return $post->ID;
  }
}

//add custom color tiny mce
function my_mce4_options( $init ) {
  $default_colours = '
  "000000", "Black",
  "993300", "Burnt orange",
  "333300", "Dark olive",
  "003300", "Dark green",
  "003366", "Dark azure",
  "000080", "Navy Blue",
  "333399", "Indigo",
  "333333", "Very dark gray",
  "800000", "Maroon",
  "FF6600", "Orange",
  "808000", "Olive",
  "008000", "Green",
  "008080", "Teal",
  "0000FF", "Blue",
  "666699", "Grayish blue",
  "808080", "Gray",
  "FF0000", "Red",
  "FF9900", "Amber",
  "99CC00", "Yellow green",
  "339966", "Sea green",
  "33CCCC", "Turquoise",
  "3366FF", "Royal blue",
  "800080", "Purple",
  "999999", "Medium gray",
  "FF00FF", "Magenta",
  "FFCC00", "Gold",
  "FFFF00", "Yellow",
  "00FF00", "Lime",
  "00FFFF", "Aqua",
  "00CCFF", "Sky blue",
  "993366", "Brown",
  "C0C0C0", "Silver",
  "FF99CC", "Pink",
  "FFCC99", "Peach",
  "FFFF99", "Light yellow",
  "CCFFCC", "Pale green",
  "CCFFFF", "Pale cyan",
  "99CCFF", "Light sky blue",
  "CC99FF", "Plum",
  "FFFFFF", "White"
  ';
  $custom_colours = '
  "ff3380", "Couleur rose resumé",
  "001964", "Couleur bleu texte"
  ';
$init['textcolor_map'] = '['.$default_colours.','.$custom_colours.']';
$init['textcolor_rows'] = 6;
$init['fontsize_formats'] = "8px 9px 10px 11px 12px 17px 20px 26px 36px";
return $init;
}
add_filter('tiny_mce_before_init', 'my_mce4_options');

//change checkbox to radio
function wpse_139269_term_radio_checklist( $args ) {
    if ( ! empty( $args['taxonomy'] ) && $args['taxonomy'] === 'category' ) {
        if ( empty( $args['walker'] ) || is_a( $args['walker'], 'Walker' ) ) {
            if ( ! class_exists( 'WPSE_139269_Walker_Category_Radio_Checklist' ) ) {
                /**
                 * Custom walker for switching checkbox inputs to radio.
                 *
                 * @see Walker_Category_Checklist
                 */
                class WPSE_139269_Walker_Category_Radio_Checklist extends Walker_Category_Checklist {
                    function walk( $elements, $max_depth, $args = array() ) {
                        $output = parent::walk( $elements, $max_depth, $args );
                        $output = str_replace(
                            array( 'type="checkbox"', "type='checkbox'" ),
                            array( 'type="radio"', "type='radio'" ),
                            $output
                        );

                        return $output;
                    }
                }
            }

            $args['walker'] = new WPSE_139269_Walker_Category_Radio_Checklist;
        }
    }

    return $args;
}

add_filter( 'wp_terms_checklist_args', 'wpse_139269_term_radio_checklist' );