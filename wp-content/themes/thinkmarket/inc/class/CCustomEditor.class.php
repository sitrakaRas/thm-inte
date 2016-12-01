<?php
class CCustomEditor {

  public function __construct(){
    add_action('init', array($this, 'init'));
    add_filter( 'mce_css', array($this, 'mce_css') );
    //add_action( 'admin_enqueue_scripts', array($this, 'admin_enqueue_scripts') );
  }

  function mce_css($mce_css){
    $mce_css .= ', ' . get_template_directory_uri() . '/styles/custom-editor.css';

    return $mce_css;
  }

  function init(){
    if ( ! current_user_can('edit_posts') && ! current_user_can('edit_pages'))
      return;

    if ( get_user_option('rich_editing') == 'true') {
      add_filter('mce_external_plugins', array($this, 'mce_external_plugins'));
      add_filter('mce_buttons', array($this, 'mce_buttons'));
    }
  }

  function admin_enqueue_scripts(){
    wp_enqueue_script( 'custom-editor', get_stylesheet_directory_uri() . '/scripts/custom-editor/custom-editor.js', array(), false, false );
  }

  function mce_external_plugins($plugin_array){
    $plugin_array['slideshare'] = get_stylesheet_directory_uri() . '/scripts/slideshare.js';
    $plugin_array['guillemet_ouvert'] = get_stylesheet_directory_uri() . '/scripts/guillemet_ouvert.js';
    $plugin_array['guillemet_fermer'] = get_stylesheet_directory_uri() . '/scripts/guillemet_fermer.js';
    return $plugin_array;
  }

  function mce_buttons($buttons) {
    array_push($buttons, "slideshare","guillemet_ouvert","guillemet_fermer");
    return $buttons;
  }
} new CCustomEditor();
