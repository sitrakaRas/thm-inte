<?php

class CFunctions {
  /*
   * On met là tous les hook exécutés par le site
   * */
  function __construct() {
    // Ajout de script FO
    add_action('wp_enqueue_scripts', array($this, 'add_front_scripts'));
    // Ajout de script BO
    add_action('admin_enqueue_scripts', array($this, 'add_admin_scripts'));
    // Add custom editor style
    add_filter('mce_css', array($this, 'add_custom_editor_style'));
    // remove some unused menu on the top black band in BO
    add_action('admin_bar_menu', array(
      $this,
      'remove_some_unused_menu_bo'
    ), 999);
    // Remove text thanks wordpress in BO
    add_filter('admin_footer_text', array($this, 'remove_thanks_bo'));
    // Remove version wordpress in BO
    add_action('admin_menu', array($this, 'remove_version_bo'));
    // Remove auto p
    add_filter('tiny_mce_before_init', array($this, 'remove_auto_p'));
    // Ajout title au menu
    add_filter('nav_menu_link_attributes', array(
      $this,
      'add_balise_title_menu'
    ), 10, 2);
    // Remove H1 + Add uppercase/lowercase style in RTE BO
    add_filter('tiny_mce_before_init', array($this, 'customize_rte'));
    // Add button "styleselect" to RTE BO
    add_filter('mce_buttons', array(
      $this,
      'add_styleselect_rte_button'
    ), 10, 2);
    /*
     * Plugin breadcrumb navxt
     * Ajout attributs meta data to li breadcrumb ==> Référencement
     *
     * */
    add_filter('bcn_breadcrumb_template', array(
      $this,
      'bcn_breadcrumb_template'
    ), 10, 3);
    add_filter('bcn_breadcrumb_template_no_anchor', array(
      $this,
      'bcn_breadcrumb_template_no_anchor'
    ), 10, 3);
    add_action('init', array($this, 'custom_init'));
    // Remove meta generator
    remove_action('wp_head', 'wp_generator');
    if (class_exists('Custom_Login')) {
      remove_action('wp_head', array(
        Custom_Login::instance(),
        'cl_version_in_header'
      ));
    }
    remove_action('wp_head', 'print_emoji_detection_script', 7);
    remove_action('admin_print_scripts', 'print_emoji_detection_script');
    remove_action('wp_print_styles', 'print_emoji_styles');
    remove_action('admin_print_styles', 'print_emoji_styles');
    remove_action('wp_head', 'rsd_link');
    remove_action('wp_head', 'wlwmanifest_link');
    remove_action('wp_head', 'index_rel_link');
    remove_action('wp_head', 'wp_shortlink_wp_head');
    remove_action('wp_head', 'feed_links', 2);
    remove_action('wp_head', 'feed_links_extra', 3);
  }

  function custom_init() {
    add_filter('bcn_allowed_html', array(
      $this,
      'bcn_allowed_attribute_html5_to_li'
    ), 1, 1);
  }

  function bcn_breadcrumb_template($template, $type, $id) {
    return '<li property="itemListElement" typeof="ListItem" >' . $template . '</li>';
  }

  function bcn_breadcrumb_template_no_anchor($template, $type, $id) {
    return '<li property="itemListElement" typeof="ListItem" >' . $template . '</li>';
  }

  function bcn_allowed_attribute_html5_to_li($tags) {
    $allowed_html = array(
      'li' => array(
        'class' => TRUE,
        'id' => TRUE,
        'relList' => TRUE,
        'rel' => TRUE,
        'aria-hidden' => TRUE,
        'data-icon' => TRUE,
        'itemref' => TRUE,
        'itemid' => TRUE,
        'itemprop' => TRUE,
        'itemscope' => TRUE,
        'itemtype' => TRUE,
        'xmlns:v' => TRUE,
        'typeof' => TRUE,
        'property' => TRUE,
        'vocab' => TRUE
      ),
      'a' => array(
        'href' => TRUE,
        'title' => TRUE,
        'class' => TRUE,
        'id' => TRUE,
        'media' => TRUE,
        'dir' => TRUE,
        'relList' => TRUE,
        'rel' => TRUE,
        'aria-hidden' => TRUE,
        'data-icon' => TRUE,
        'itemref' => TRUE,
        'itemid' => TRUE,
        'itemprop' => TRUE,
        'itemscope' => TRUE,
        'itemtype' => TRUE,
        'xmlns:v' => TRUE,
        'typeof' => TRUE,
        'property' => TRUE,
        'vocab' => TRUE
      ),
      'img' => array(
        'alt' => TRUE,
        'align' => TRUE,
        'height' => TRUE,
        'width' => TRUE,
        'src' => TRUE,
        'id' => TRUE,
        'class' => TRUE,
        'aria-hidden' => TRUE,
        'data-icon' => TRUE,
        'itemref' => TRUE,
        'itemid' => TRUE,
        'itemprop' => TRUE,
        'itemscope' => TRUE,
        'itemtype' => TRUE,
        'xmlns:v' => TRUE,
        'typeof' => TRUE,
        'property' => TRUE,
        'vocab' => TRUE
      ),
      'span' => array(
        'title' => TRUE,
        'class' => TRUE,
        'id' => TRUE,
        'dir' => TRUE,
        'align' => TRUE,
        'lang' => TRUE,
        'xml:lang' => TRUE,
        'aria-hidden' => TRUE,
        'data-icon' => TRUE,
        'itemref' => TRUE,
        'itemid' => TRUE,
        'itemprop' => TRUE,
        'itemscope' => TRUE,
        'itemtype' => TRUE,
        'xmlns:v' => TRUE,
        'typeof' => TRUE,
        'property' => TRUE,
        'vocab' => TRUE
      ),
      'h1' => array(
        'title' => TRUE,
        'class' => TRUE,
        'id' => TRUE,
        'dir' => TRUE,
        'align' => TRUE,
        'lang' => TRUE,
        'xml:lang' => TRUE,
        'aria-hidden' => TRUE,
        'data-icon' => TRUE,
        'itemref' => TRUE,
        'itemid' => TRUE,
        'itemprop' => TRUE,
        'itemscope' => TRUE,
        'itemtype' => TRUE,
        'xmlns:v' => TRUE,
        'typeof' => TRUE,
        'property' => TRUE,
        'vocab' => TRUE
      ),
      'h2' => array(
        'title' => TRUE,
        'class' => TRUE,
        'id' => TRUE,
        'dir' => TRUE,
        'align' => TRUE,
        'lang' => TRUE,
        'xml:lang' => TRUE,
        'aria-hidden' => TRUE,
        'data-icon' => TRUE,
        'itemref' => TRUE,
        'itemid' => TRUE,
        'itemprop' => TRUE,
        'itemscope' => TRUE,
        'itemtype' => TRUE,
        'xmlns:v' => TRUE,
        'typeof' => TRUE,
        'property' => TRUE,
        'vocab' => TRUE
      ),
      'meta' => array(
        'content' => TRUE,
        'property' => TRUE,
        'vocab' => TRUE
      )
    );
    return mtekk_adminKit::array_merge_recursive($tags, $allowed_html);
  }

  function add_styleselect_rte_button($buttons, $editor_id) {
    /* Add it as first item in the row */
    array_unshift($buttons, 'styleselect');
    return $buttons;
  }

  function customize_rte($settings) {
    $settings[ 'block_formats' ] = 'Paragraph=p;Heading 2=h2;Heading 3=h3;Heading 4=h4';
    /* List all options as multi dimension array */
    $style_formats = array(
      array(
        'title' => 'Uppercase',
        /* Title of the option drop down */
        'inline' => 'span',
        /* use "inline" or "block" as key and the element wrapper ( "div", "span", "etc" ) as value. */
        'styles' => array(
          'text-transform' => 'uppercase',
        ),
      ),
      array(
        'title' => 'Lowercase',
        /* Title of the option drop down */
        'inline' => 'span',
        /* use "inline" or "block" as key and the element wrapper ( "div", "span", "etc" ) as value. */
        'styles' => array(
          'text-transform' => 'lowercase',
        ),
      ),
    );
    /* Add it in tinymce config as json data */
    $settings[ 'style_formats' ] = json_encode($style_formats);
    return $settings;
  }

  function add_balise_title_menu($atts, $item) {
    $atts[ 'title' ] = strip_tags($item->title);
    return $atts;
  }

  function remove_auto_p($init) {
    $init[ 'wpautop' ] = FALSE;
    return $init;
  }

  function remove_version_bo() {
    remove_filter('update_footer', 'core_update_footer');
  }

  function remove_thanks_bo() {
    return '';
  }

  function remove_some_unused_menu_bo($wp_admin_bar) {
    $wp_admin_bar->remove_node('wp-logo');
    $wp_admin_bar->remove_menu('view');
    $wp_admin_bar->remove_menu('comments');
    $wp_admin_bar->remove_menu('new-content');
  }

  function add_custom_editor_style($mce_css) {
    $mce_css .= ', ' . get_stylesheet_directory_uri() . '/styles/custom-editor-style.css?' . time();
    return $mce_css;
  }

  function add_admin_scripts() {
    wp_enqueue_style('custom-admin-style', get_stylesheet_directory_uri() . '/styles/admin-style.css?' . time());
  }

  function add_front_scripts() {
    wp_enqueue_style('custom-vendor-style', get_stylesheet_directory_uri() . '/styles/vendor.css?' . time());
    wp_enqueue_style('custom-front-style', get_stylesheet_directory_uri() . '/styles/main.css?' . time());
    wp_enqueue_script('custom-vendor-script', get_stylesheet_directory_uri() . '/scripts/vendor.js?' . time(), array(), FALSE, TRUE);
    wp_enqueue_script('custom-front-script', get_stylesheet_directory_uri() . '/scripts/main.js?' . time(), array(), FALSE, TRUE);    
    wp_localize_script('custom-front-script', 'admin', array(
      'ajaxurl' => admin_url('admin-ajax.php')
    ));

    wp_localize_script('custom-front-script', 'site', array(
      'stylesheet_directory_uri' => get_stylesheet_directory_uri()
    ));
   
  }

}// ./class CFunctions

$cf = new CFunctions();