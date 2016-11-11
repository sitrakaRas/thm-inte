<?php

class COffre {

  private static $_elements;

  public function __construct($id = FALSE) {
  }

  private static function _load($pid) {

    $pid = intval($pid);
    $p = get_post($pid);

    if ($p->post_type == "offre") {

      $element = new stdClass ();

      $element->ID = $p->ID;
      $element->type = 'offre';
      $element->image = get_field("image",$p->ID);
      $element->permalink = get_permalink($p->ID);
      $element->titre = apply_filters('the_title', $p->post_title, $p->ID);
      $element->description = preg_replace("/(\r\n|\n|\r)/", "", apply_filters('the_content', $p->post_content));
      $element->date_publication = get_the_time('d/m/Y', $p->ID);

      // stocker dans le tableau statique
      self::$_elements [ $pid ] = $element;
    }
  }

  public static function getById($pid) {
    $pid = intval($pid);
    if (!isset (self::$_elements [ $pid ])) {
      self::_load($pid);
    }
    if (!isset (self::$_elements [ $pid ])) {
      return FALSE;
    }
    return self::$_elements [ $pid ];
  }

  public static function getAll($posts_per_page = -1, $paged = 1, $with_query = FALSE, $id_only = FALSE, $order = 'DESC', $orderby = 'date') {

    $args = array(
      'post_type' => 'offre',
      'post_status' => 'publish',
      'posts_per_page' => $posts_per_page,
      'paged' => $paged,
      'order' => $order,
      'orderby' => $orderby,
      'fields' => 'ids',
    );

    $elements = new WP_Query ($args);
    $query = $elements;

    if ($elements->have_posts()) {
      $elts = array();
      $elements = $elements->posts;
      if (!$id_only) {
        foreach ($elements as $id) {
          $elt = self::getById(intval($id));
          $elts[] = $elt;
        }
        $elements = $elts;
      }
    }
    else {
      $elements = FALSE;
    }

    wp_reset_postdata();

    if ($with_query) {
      return array(
        'results' => $elements,
        'query' => $query
      );
    }
    else {
      return $elements;
    }

  }

}// ./CActualite
