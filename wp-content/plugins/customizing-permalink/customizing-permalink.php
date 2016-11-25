<?php
/*
Plugin Name: Customizing-permalink
Version: 1.0.2016
Description: Personnalise les permaliens de vos contenus.
Author: Bocasay
Author URI: http://www.bocasay.com
Created: 13/07/2016
*/

define('CustoPerm_DIR', untrailingslashit(plugin_dir_path(__FILE__)));
define('CustoPerm_URI', untrailingslashit(plugin_dir_url(__FILE__)));

class CustoPerm {

  function __construct() {
    add_action('admin_enqueue_scripts', array(
      $this,
      'add_admin_enqueue_scripts'
    ));
    add_action('admin_menu', array($this, 'add_menu_page'));
    //Rewrite url
    add_filter('post_link', array($this, 'custom_post_link'), 999, 3);
    add_filter('post_type_link', array($this, 'custom_post_type_link'), 999, 3);
    add_filter('term_link', array($this, 'custom_term_link'), 999, 3);
    add_action('init', array($this, 'flush_rewrite_rules'));
    add_action('generate_rewrite_rules', array(
      $this,
      'create_custom_rewrite_rules'
    ), 999);
  }

  function flush_rewrite_rules() {
    global $wp_rewrite;

    $wp_rewrite->flush_rules();
  }

  function create_custom_rewrite_rules($wp_rewrite) {
    global $wp_rewrite, $wpdb;
    $customize = get_option('customizing_permalink');
    remove_action('template_redirect', 'redirect_canonical');
    if (!empty($customize)) {
      foreach ($customize as $post_type => $row) {
        /*
         * CAS 1 : /../
         */
        if (preg_match("#.*?\/$#", $_SERVER[ 'REQUEST_URI' ])) {
          /*
           * /post_name/
           */
          $req_uri = explode('/', $_SERVER[ 'REQUEST_URI' ]);
          array_pop($req_uri);
          $slug = end($req_uri);
          $req = "SELECT post_type FROM " . $wpdb->prefix . "posts WHERE post_name='" . $slug . "'";
          $posttype = $wpdb->get_var($req);
          if ($posttype != 'post' && $posttype != 'page' && $posttype == $post_type) {
            $rewrite_keywords_structure = $wp_rewrite->root . "%" . $post_type . "%/";
            // Generate the rewrite rules
            $this->generate_rewrite_rule($wp_rewrite, $rewrite_keywords_structure);
          }
          /*
           * /slug_term/
           */
          $taxonomies = get_taxonomies(array('object_type' => array($post_type)));
          if($taxonomies && !empty($taxonomies)) {
            foreach ($taxonomies as $taxo) {
              $curr_term = get_term_by('slug', $slug, $taxo);
              if(isset($curr_term->term_id) && $curr_term->term_id > 0) {
                // Define custom rewrite tokens
                $taxo_slug = '%taxo_slug_' . $post_type . '%';
                // Define the custom permalink structure
                $rewrite_keywords_structure = $wp_rewrite->root . $taxo_slug . "/";
                // Add the rewrite tokens
                if ($taxo == 'category') {
                  $wp_rewrite->add_rewrite_tag($taxo_slug, '(.*?)', 'category_name=');
                }
                else {
                  $wp_rewrite->add_rewrite_tag($taxo_slug, '(.*?)', $taxo. '=');
                }
                // Generate the rewrite rules
                $this->generate_rewrite_rule($wp_rewrite, $rewrite_keywords_structure);
              }
            }
          }
        }
        /*
         * CAS 2 : /../../
         */
        if (preg_match("#.*?\/(.+?)\/$#", $_SERVER[ 'REQUEST_URI' ])) {
          $req_uri = explode('/', $_SERVER[ 'REQUEST_URI' ]);
          array_pop($req_uri);
          $slug2 = end($req_uri);
          array_pop($req_uri);
          $slug1 = end($req_uri);
          /*
           * /slug_term/post_name/
           */
          if (!empty($customize[$post_type]['slug_taxonomy'])) {
            $curr_term = get_term_by('slug', $slug1, $customize[$post_type]['slug_taxonomy']);
            if(isset($curr_term->term_id) && $curr_term->term_id > 0) {
              if ($this->is_in_post_type($slug2, $post_type)) {
                // Define custom rewrite tokens
                $tax_slug = '%tax_slug_' . $post_type . '%';

                // Define the custom permalink structure
                if ($post_type == 'post') {
                  $rewrite_keywords_structure = $wp_rewrite->root . $tax_slug . "/%postname%/";
                }
                else {
                  $rewrite_keywords_structure = $wp_rewrite->root . $tax_slug . "/%" . $post_type . "%/";
                }
                // Add the rewrite tokens
                $wp_rewrite->add_rewrite_tag($tax_slug, '(.+?)', 'post_type=' . $post_type . '');
                // Generate the rewrite rules
                $this->generate_rewrite_rule($wp_rewrite, $rewrite_keywords_structure);
              }
            }
          }

          if (isset($customize[$post_type]['slug_listing_page']) && $slug1 == $customize[$post_type]['slug_listing_page']) {
            /*
             * /page_listing/post_name/
             */
            if ($this->is_in_post_type($slug2, $post_type)) {
              /*
               * /page_listing/post_name/
               */
              // Define the custom permalink structure
              if ($post_type == 'post') {
                $rewrite_keywords_structure = $wp_rewrite->root . $row[ 'slug_listing_page' ] . "/%postname%/";
              }
              else {
                $rewrite_keywords_structure = $wp_rewrite->root . $row[ 'slug_listing_page' ] . "/%" . $post_type . "%/";
              }
              // Generate the rewrite rules
              $this->generate_rewrite_rule($wp_rewrite, $rewrite_keywords_structure);
            }
            /*
             * /page_listing/slug_term/
             */
            $taxonomies = get_taxonomies(array('object_type' => array($post_type)));
            if($taxonomies && !empty($taxonomies)) {
              foreach ($taxonomies as $taxo) {
                $curr_term = get_term_by('slug', $slug2, $taxo);
                if (isset($curr_term->term_id) && $curr_term->term_id > 0) {
                  // Define custom rewrite tokens
                  $taxo_slug = '%taxo_slug_' . $post_type . '%';

                  // Define the custom permalink structure
                  $rewrite_keywords_structure = $wp_rewrite->root . $row[ 'slug_listing_page' ] . '/' . $taxo_slug . "/";

                  // Add the rewrite tokens
                  if ($taxo == 'category') {
                    $wp_rewrite->add_rewrite_tag($taxo_slug, '(.*?)', 'category_name=');
                  }
                  else {
                    $wp_rewrite->add_rewrite_tag($taxo_slug, '(.*?)', $taxo . '=');
                  }
                  // Generate the rewrite rules
                  $this->generate_rewrite_rule($wp_rewrite, $rewrite_keywords_structure);
                }
              }
            }
          }
        }
        /*
         * CAS 3 : /../../../
         */
        if (preg_match("#.*?\/(.+?)\/(.+?)\/$#", $_SERVER[ 'REQUEST_URI' ])) {
          /*
           * /page_listing/slug_term/post_name
           */
          if (!empty($row['slug_taxonomy']) && !empty($row['slug_listing_page'])) {
            $req_uri = explode('/', $_SERVER[ 'REQUEST_URI' ]);
            array_pop($req_uri);
            $slug_post = end($req_uri);
            if ($this->is_in_post_type($slug_post, $post_type)) {
              // Define custom rewrite tokens
              $tax_slug = '%tax_slug_' . $post_type . '%';

              // Define the custom permalink structure
              if ($post_type == 'post') {
                $rewrite_keywords_structure = $wp_rewrite->root . $row[ 'slug_listing_page' ] . '/' . $tax_slug . "/%postname%/";
              }
              else {
                $rewrite_keywords_structure = $wp_rewrite->root . $row[ 'slug_listing_page' ] . '/' . $tax_slug . "/%" . $post_type . "%/";
              }
              // Add the rewrite tokens
              $wp_rewrite->add_rewrite_tag($tax_slug, '(.+?)', 'post_type=' . $post_type . '');
              // Generate the rewrite rules
              $this->generate_rewrite_rule($wp_rewrite, $rewrite_keywords_structure);
            }
          }
        }
      }
    }
    return $wp_rewrite->rules;
  }

  function is_in_post_type($postname = '', $post_type = '') {
    global $wpdb;
    $req = "SELECT ID FROM " . $wpdb->prefix . "posts WHERE post_name='" . $postname . "' AND post_type = '".$post_type."'";
    $id_post = $wpdb->get_var($req);
    if($id_post > 0) return TRUE;
    else return FALSE;
  }

  function generate_rewrite_rule($wp_rewrite, $rewrite_keywords_structure) {
    $new_rule = $wp_rewrite->generate_rewrite_rules($rewrite_keywords_structure);
    $wp_rewrite->rules = $new_rule + $wp_rewrite->rules;
  }
  
  function custom_post_type_link($permalink, $post, $leavename) {
    $customize = get_option('customizing_permalink');
    $uri = explode('/', $permalink);
    array_pop($uri);
    $postname = end($uri);
    array_pop($uri);
    array_pop($uri);
    if (!empty($customize)) {
      foreach ($customize as $post_type => $row) {
        if ($post_type != 'post') {
          if ($post->post_type == $post_type) {
            // Avec page listing / Sans category
            if (!empty($customize[ $post_type ][ 'slug_listing_page' ]) && empty($customize[ $post_type ][ 'slug_taxonomy' ])) {
              $uri[] = $customize[ $post_type ][ 'slug_listing_page' ] . '/' . $postname . '/';
              $permalink = implode('/', $uri);
            }
            // Avec page listing / Avec category
            if (!empty($customize[ $post_type ][ 'slug_listing_page' ]) && !empty($customize[ $post_type ][ 'slug_taxonomy' ])) {
              list($cat) = wp_get_post_terms($post->ID, $customize[ 'post' ][ 'slug_taxonomy' ], array('fields' => 'all'));
              if (isset($cat->slug) && !empty($cat->slug)) {
                $uri[] = $customize[ $post_type ][ 'slug_listing_page' ] . '/' . $cat->slug . '/' . $postname . '/';
                $permalink = implode('/', $uri);
              }
            }
            // Sans page listing / Avec category
            if (empty($customize[ $post_type ][ 'slug_listing_page' ]) && !empty($customize[ $post_type ][ 'slug_taxonomy' ])) {
              list($cat) = wp_get_post_terms($post->ID, $customize[ $post_type ][ 'slug_taxonomy' ], array('fields' => 'all'));
              if (isset($cat->slug) && !empty($cat->slug)) {
                $uri[] = $cat->slug . '/' . $postname . '/';
                $permalink = implode('/', $uri);
              }
            }
            // Sans page listing / Sans category
            if (empty($customize[ $post_type ][ 'slug_listing_page' ]) && empty($customize[ $post_type ][ 'slug_taxonomy' ])) {
              $uri[] = $postname . '/';
              $permalink = implode('/', $uri);
            }
          }
        }
      }
    }
    return $permalink;
  }

  function custom_post_link($permalink, $post, $leavename) {
    $customize = get_option('customizing_permalink');
    $uri = explode('/', $permalink);
    array_pop($uri);
    $postname = end($uri);
    array_pop($uri);
    if ($post->post_type == 'post') {
      // Avec page listing / Sans category
      if (!empty($customize[ 'post' ][ 'slug_listing_page' ]) && empty($customize[ 'post' ][ 'slug_taxonomy' ])) {
        $uri[] = $customize[ 'post' ][ 'slug_listing_page' ] . '/' . $postname . '/';
        $permalink = implode('/', $uri);
      }
      // Avec page listing / Avec category
      if (!empty($customize[ 'post' ][ 'slug_listing_page' ]) && !empty($customize[ 'post' ][ 'slug_taxonomy' ])) {
        list($cat) = wp_get_post_terms($post->ID, $customize[ 'post' ][ 'slug_taxonomy' ], array('fields' => 'all'));
        if (isset($cat->slug) && !empty($cat->slug)) {
          $uri[] = $customize[ 'post' ][ 'slug_listing_page' ] . '/' . $cat->slug . '/' . $postname . '/';
          $permalink = implode('/', $uri);
        }
      }
      // Sans page listing / Avec category
      if (empty($customize[ 'post' ][ 'slug_listing_page' ]) && !empty($customize[ 'post' ][ 'slug_taxonomy' ])) {
        list($cat) = wp_get_post_terms($post->ID, $customize[ 'post' ][ 'slug_taxonomy' ], array('fields' => 'all'));
        if (isset($cat->slug) && !empty($cat->slug)) {
          $uri[] = $cat->slug . '/' . $postname . '/';
          $permalink = implode('/', $uri);
        }
      }
    }
    return $permalink;
  }

  function custom_term_link($termlink, $term, $taxonomy) {
    $customize = get_option('customizing_permalink');
    if (!empty($customize)) {
      foreach ($customize as $post_type => $row) {
        // La taxonomy doit être rattachée au post type encours
        $taxo_posttype = get_object_taxonomies($post_type);
        if (isset($taxo_posttype) && !empty($taxo_posttype) && in_array($taxonomy, $taxo_posttype)) {
          // Avec page listing
          if (!empty($customize[ $post_type ][ 'slug_listing_page' ])) {
            $termlink = str_replace($taxonomy . '/', $customize[ $post_type ][ 'slug_listing_page' ] . '/', $termlink);
          }
          // Sans page listing
          if (empty($customize[ $post_type ][ 'slug_listing_page' ])) {
            $termlink = str_replace($taxonomy . '/', '', $termlink);
          }
        }
      }
    }
    return $termlink;
  }

  function selection_type_page_callback() {
    ?>
    <div id="add" class="wrap">
      <h2>Sélectionnez les types à personnaliser</h2>
      <?php
      $post_types = get_post_types();
      unset($post_types[ 'page' ]);
      unset($post_types[ 'attachment' ]);
      unset($post_types[ 'revision' ]);
      unset($post_types[ 'nav_menu_item' ]);
      unset($post_types[ 'mc4wp-form' ]);
      unset($post_types[ 'acf' ]);
      if (isset($_POST[ 'selection_types' ])) {
        if (isset($_POST[ 'post_type' ]) && !empty($_POST[ 'post_type' ])) {
          $types = $_POST[ 'post_type' ];
          update_option('types_to_customize_permalink', $types);
        }
        else {
          update_option('types_to_customize_permalink', '');
        }
        echo '<p style="color:green; font-size:18px">L\'enregistrement a été effectué.</p>';
      }
      $types_saved = get_option('types_to_customize_permalink');
      ?>
      <form action="" method="post">
        <table width="100%">
          <tbody>
          <?php
          if (!empty($post_types)):
            foreach ($post_types as $type):
              ?>
              <tr>
                <th width="100" align="right"><?php echo $type; ?></th>
                <td><input type="checkbox" name="post_type[]" value="<?php echo $type; ?>" <?php if (isset($types_saved) && !empty($types_saved) && in_array($type, $types_saved)): echo 'checked'; endif; ?>></td>
              </tr>
              <?php
            endforeach;
          endif;
          ?>
          <tr>
            <th></th>
            <td>
              <input type="submit" value="Enregistrer" name="selection_types" class="button-primary">
            </td>
          </tr>
          </tbody>
        </table>
      </form>
    </div>
    <?php
  }

  function menu_page_callback() {
    ?>
    <div id="add" class="wrap metabox-holder">
      <h2>Personnalisez vos permaliens</h2>
      <?php
      $res = array();
      $types_saved = get_option('types_to_customize_permalink');
      if (isset($_POST[ 'is_selection_types' ])):
        if (!empty($types_saved)):
          foreach ($types_saved as $type):
            $tab = array();
            if(isset($_POST[ $type . '_slug_listing_page' ])) {
              $tab[ 'slug_listing_page' ] = $_POST[ $type . '_slug_listing_page' ];
            }
            if(isset($_POST[ $type . '_slug_taxonomy' ])) {
              $tab[ 'slug_taxonomy' ] = $_POST[ $type . '_slug_taxonomy' ];
            }
            $res[ $type ] = $tab;
          endforeach;
        endif;
        update_option('customizing_permalink', $res);
        echo '<p style="color:green; font-size:18px">L\'enregistrement a été effectué.</p>';
      endif;
      $customize = get_option('customizing_permalink');

      $types_saved = get_option('types_to_customize_permalink');
      if (!$types_saved || empty($types_saved)):
        echo '<h2>Veuillez enregistrer les types à personnaliser en cliquant <a href="' . admin_url('admin.php?page=selection-type') . '">ici</a></h2>';
      else:
        ?>
        <form action="" method="post">
          <?php
          if (!empty($types_saved)):
            foreach ($types_saved as $type):
              ?>
              <hr>
              <div class="postbox"><h2 class="hndle"><?php echo $type; ?></h2>
              </div>
              <table width="100%">
                <tbody>
                <tr>
                  <th width="100" align="right">Page listing :</th>
                  <td>
                    <?php
                    $pages = get_pages();
                    if (!empty($pages)):
                      foreach ($pages as $page):
                        ?>
                        <input type="checkbox" <?php if (isset($customize[ $type ][ 'slug_listing_page' ]) && $page->post_name == $customize[ $type ][ 'slug_listing_page' ]) { echo 'checked'; } ?> name="<?php echo $type . '_slug_listing_page'; ?>" value="<?php echo $page->post_name; ?>"><?php echo $page->post_title; ?><br>
                        <?php
                      endforeach;
                    endif;
                    ?>
                    <hr>
                  </td>
                </tr>
                <tr>
                  <th width="100" align="right">Catégorie :</th>
                  <td>
                    <?php
                    $taxonomies = get_taxonomies(array('object_type' => array($type)));
                    if (!empty($taxonomies)):
                      foreach ($taxonomies as $slug_taxo):
                        if (!in_array($slug_taxo, array(
                          'post_tag',
                          'nav_menu',
                          'link_category',
                          'post_format'
                        ))
                        ):
                          ?>
                          <input type="checkbox" <?php if (isset($customize[ $type ][ 'slug_taxonomy' ]) && $slug_taxo == $customize[ $type ][ 'slug_taxonomy' ]) {echo 'checked';} ?> name="<?php echo $type . '_slug_taxonomy'; ?>" value="<?php echo $slug_taxo; ?>"><?php echo $slug_taxo; ?><br>
                          <?php
                        endif;
                      endforeach;
                    endif;
                    ?>
                  </td>
                </tr>
                </tbody>
              </table>
              <?php
            endforeach;
          endif;
          ?>
          <hr>
          <table width="100%">
            <tbody>
            <tr>
              <th></th>
              <td>
                <input type="hidden" name="is_selection_types" value="true">
                <input type="submit" value="Enregistrer" name="selection_types"
                       class="button-primary">
              </td>
            </tr>
            </tbody>
          </table>
        </form>
        <?php
      endif;
      ?>
    </div>
    <?php
  }

  function add_menu_page() {
    add_menu_page('Personnalisation des permaliens', 'Personnalisation des permaliens', 'manage_options', 'customizing-permalink', array(
      $this,
      'menu_page_callback'
    ));
    add_submenu_page('customizing-permalink', 'Sélection des types à personnaliser', 'Sélection des types à personnaliser', 'manage_options', 'selection-type', array(
      $this,
      'selection_type_page_callback'
    ));
  }

  function add_admin_enqueue_scripts() {
    wp_enqueue_style('CustoPerm-style-1', CustoPerm_URI . '/css/customizing-permalink-admin-style.css');
    wp_enqueue_script('CustomPerm-script', CustoPerm_URI . '/js/customizing-permalink.js');
  }

}

$_CustoPerm = new CustoPerm();



