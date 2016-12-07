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

    add_action( 'wp_ajax_get_item_article', array( $this, 'get_item_article' ), 1 );
    add_action( 'wp_ajax_nopriv_get_item_article', array( $this, 'get_item_article' ), 1 );
  }

  function get_item_article(){
    $term_id = $_POST['term_id'];
    $offset = $_POST['offset'];
    $old_number = $_POST['old_number'];
    $total = CActualite::getAll();

    if(isset($term_id) && $term_id != null){
      //si term id defini
      //calcul nbre actu meme categ
      $total_actu = 0;
      foreach ($total as  $actu) {
        $categ = wp_get_post_terms($actu->ID, 'category', array("fields" => "all"));
        if($term_id == $categ[0]->term_id){
          $total_actu++;
        }
      }

      $total = $total_actu;
      //si total plus que l' offset
      if($total > (int)$offset ){
        if( $total - ($old_number + 6)  > 0){
          $actus = CActualite::getAll(6,$offset);
          $fin = false;         
          $html = "";
          foreach ($actus as  $actu) {
            $categ = wp_get_post_terms($actu->ID, 'category', array("fields" => "all"));
            if($term_id == $categ[0]->term_id):
              $html .= $this->render_item_article($actu,$offset,$total,$categ);
              (int)$offset++;
            endif;
          }                   
            //$html .= $this->render_tweeter_block();

        }else{
          //le nombre restant par rapport au total 

          $nbr = $total - $old_number ;
          if($nbr > 0){      
            $actus = CActualite::getAll($nbr,$offset);
            foreach ($actus as  $actu) {
              $categ = wp_get_post_terms($actu->ID, 'category', array("fields" => "all"));
              if($term_id == $categ[0]->term_id):
                $html .= $this->render_item_article($actu,$offset,$total,$categ);
                (int)$offset++;
              endif;
            }
          }
          $fin = true;
          $html .= $this->render_tweeter_block();
        }
      }else{
        $fin = true;
        $html .= $this->render_tweeter_block();
      }
      

    }else{
      //si pas de term id defini
      if(count($total) > (int)$offset ){
        if( count($total) - ($old_number + 6)  > 0){
          $actus = CActualite::getAll(6,$offset);
          $fin = false;       
            $html = ""; 
            foreach ($actus as  $actu) {
              $categ = wp_get_post_terms($actu->ID, 'category', array("fields" => "all"));
              $html .= $this->render_item_article($actu,$offset,count($total),$categ);
              (int)$offset++;
            }                   
        }else{
          $nbr = count($total) - $old_number ;
          if(  $nbr > 0){
            $actus = CActualite::getAll($nbr,$offset);
          
            foreach ($actus as  $actu) {
              $categ = wp_get_post_terms($actu->ID, 'category', array("fields" => "all"));
              $html .= $this->render_item_article($actu,(int)$offset,count($total),$categ);
              (int)$offset++;
            }
          }
          $html .= $this->render_tweeter_block();
          $fin = true;
          
        }
      }else{
          $html .= $this->render_tweeter_block();
         $fin = true;
         
      }
     
    }

    $html .= $this->render_tweeter_block();
    
    echo json_encode(array('html' => $html,
      'fin' => $fin,
      'offset' => (int)$offset,
      'term_id' => $term_id,
      'total' => count($total),
      'old_number' => $old_number + count($actus),
      'nbr' => $nbr,
      'total_actu' => $total_actu,
      "test" => $test
    ));
    die();
  }
  function render_item_article($actu, $key = 0,$count,$categ){
    $link_actu = get_the_permalink(wp_get_post_by_template("template/template-actualite.php"));
    $html = '';

    $html .= '<div class="col-md-4 all ' . $categ[0]->slug . '" data-offset="' . $key . '" data-count="'. $count .'">
      <div class="actu-bloc">
        <a href="' . $actu->permalink . '">
          <div class="img-block" style="background-image: url(\'' . get_the_post_thumbnail_url($actu->ID, "large") . '\');">
          </div>
        </a>
        <div class="text-actu">
          <h3>
            <a href=".' .$link_actu.'?term_id='.$categ[0]->term_id. '">' . $categ[0]->name . '</a>
          </h3>
          <p>&Eacute;crit par ' . get_field('auteur_article', $actu->ID) . '</p>
          <a href="' . $actu->permalink . '">' . $actu->titre . '</a>
          <div class="summary">
            <p>' . get_the_excerpt($actu->ID) . '</p>
          </div>
        </div>
        <div class="bottom-link">
          <div class="link-more">
            <a href="' . $actu->permalink . '">lire la suite</a>
          </div>
        </div>
      </div>
    </div>';

    return $html;
  }

  function render_tweeter_block(){
    $html ='';
      $html .= '<div class="col-md-4 bltw twitter-mobile">
                <div class="twitter-block">
                    <h3><a href="https://twitter.com/' . get_field('id_twitter', 'option') . '" target="_blank">nos tweets</a></h3>
                    <div class="listing">
                       <a class="twitter-timeline" href="https://twitter.com/' . get_field('id_twitter', 'option') . '" data-show-replies="false"  data-aria-polite="assertive" data-chrome="nofooter noborders noheader transparent" data-tweet-limit="5">' . get_field('id_twitter', 'option') . '</a> <script async src="//platform.twitter.com/widgets.js" charset="utf-8"></script>
                    </div>
                </div>     
                <div class="bottom-link">
                  <div class="link-more">
                        <a href="https://twitter.com/' . get_field('id_twitter', 'option') . '" target="_blank">tweet</a>
                    </div> 
                </div>   
            </div>';
      return $html;
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
    $settings[ 'block_formats' ] = 'Paragraph=p;Heading 1=h1;Heading 2=h2;Heading 3=h3;Heading 4=h4';
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
    wp_enqueue_script('custom-front-script', get_stylesheet_directory_uri() . '/scripts/custom-script.js?' . time(), array(), FALSE, TRUE);    
    wp_enqueue_script('custom-script', get_stylesheet_directory_uri() . '/scripts/main.js?' . time(), array(), FALSE, TRUE);    
    wp_localize_script('custom-front-script', 'admin', array(
      'ajaxurl' => admin_url('admin-ajax.php')
    ));

    wp_localize_script('custom-front-script', 'site', array(
      'stylesheet_directory_uri' => get_stylesheet_directory_uri()
    ));
   
  }

}// ./class CFunctions

$cf = new CFunctions();