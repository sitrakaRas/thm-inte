<?php
add_action('init', 'configuration_post_type', 0);
function configuration_post_type() {
	/* POST TYPE Footer */
	$labels = array(
		'name'                => 'footer',
		'singular_name'       => 'Footer',
		'menu_name'           => 'Footer',
		'parent_item_colon'   => 'Elément parent',
		'all_items'           => 'Tous les footers',
		'view_item'           => 'Voir Footer',
		'add_new_item'        => 'Ajouter un Footer',
		'add_new'             => 'Ajouter',
		'edit_item'           => 'Editer un Footer',
		'update_item'         => 'Mettre à jour',
		'search_items'        => 'Chercher',
		'not_found'           => 'Aucun résultat trouvé',
		'not_found_in_trash'  => 'Aucun résultat trouvé dans la corbeille',
	);
	
	$args = array(
		'label'               => 'Footer',
		 'description'         => 'Footer',
		'labels'              => $labels,
		'supports'            => array( 'title' ),
		'public'              => true,
		'has_archive'         => true,
    );
	register_post_type( 'footer', $args );

	/* POST TYPE partenaire */
	$labels = array(
		'name'                => 'partenaire',
		'singular_name'       => 'Partenaire',
		'menu_name'           => 'Partenaire',
		'parent_item_colon'   => 'Elément parent',
		'all_items'           => 'Tous les partenaires',
		'view_item'           => 'Voir partenaire',
		'add_new_item'        => 'Ajouter un partenaire',
		'add_new'             => 'Ajouter',
		'edit_item'           => 'Editer un partenaire',
		'update_item'         => 'Mettre à jour',
		'search_items'        => 'Chercher',
		'not_found'           => 'Aucun résultat trouvé',
		'not_found_in_trash'  => 'Aucun résultat trouvé dans la corbeille',
	);
	
	$args = array(
		'label'               => 'Partenaire',
		 'description'         => 'partenaire',
		'labels'              => $labels,
		'supports'            => array( 'title' ),
		'public'              => true,
		'has_archive'         => true,
		'menu_icon' 		  => 'dashicons-groups',
    );
	register_post_type( 'partenaire', $args );

}

add_action( 'admin_menu', 'myprefix_adjust_the_wp_menu', 999 );
function myprefix_adjust_the_wp_menu() {
  //Get user id
  $current_user = wp_get_current_user();
  $user_id = $current_user->ID;

  //Get number of posts authored by user
  $args = array('post_type' =>'footer','author'=>$user_id,'fields'>'ids');
  $count = count(get_posts($args));

  //Conditionally remove link:
  if($count>1)
       $page = remove_submenu_page( 'edit.php?post_type=footer', 'post-new.php?post_type=footer' );
}



