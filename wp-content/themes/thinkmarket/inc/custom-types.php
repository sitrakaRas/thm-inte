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

	/* POST TYPE client */
	$labels = array(
		'name'                => 'client',
		'singular_name'       => 'Client',
		'menu_name'           => 'Client',
		'parent_item_colon'   => 'Elément parent',
		'all_items'           => 'Tous les Clients',
		'view_item'           => 'Voir Client',
		'add_new_item'        => 'Ajouter un Client',
		'add_new'             => 'Ajouter',
		'edit_item'           => 'Editer un Client',
		'update_item'         => 'Mettre à jour',
		'search_items'        => 'Chercher',
		'not_found'           => 'Aucun résultat trouvé',
		'not_found_in_trash'  => 'Aucun résultat trouvé dans la corbeille',
	);
	
	$args = array(
		'label'               => 'Client',
		 'description'         => 'client',
		'labels'              => $labels,
		'supports'            => array( 'title' ,'thumbnail'),
		'public'              => true,
		'has_archive'         => true,
		'menu_icon' 		  => 'dashicons-businessman',
    );
	register_post_type( 'client', $args );

	/* POST TYPE offre */
	$labels = array(
		'name'                => 'offre',
		'singular_name'       => 'offre',
		'menu_name'           => 'offre',
		'parent_item_colon'   => 'Elément parent',
		'all_items'           => 'Tous les offres',
		'view_item'           => 'Voir offre',
		'add_new_item'        => 'Ajouter un offre',
		'add_new'             => 'Ajouter',
		'edit_item'           => 'Editer un offre',
		'update_item'         => 'Mettre à jour',
		'search_items'        => 'Chercher',
		'not_found'           => 'Aucun résultat trouvé',
		'not_found_in_trash'  => 'Aucun résultat trouvé dans la corbeille',
	);
	
	$args = array(
		'label'               => 'offre',
		 'description'         => 'offre',
		'labels'              => $labels,
		'supports'            => array( 'title'),
		'public'              => true,
		'has_archive'         => true,
		'menu_icon' 		  => 'dashicons-tickets-alt',
    );
	register_post_type( 'offre', $args );

	// Post type actu
	$labels = array(
			'name' => 'Actualites',
			'singular_name' => 'Actualite',
			'add_new' => 'Ajouter',
			'all_items' => 'Tous les Actualites',
			'add_new_item' => 'Ajouter Actualite',
			'edit_item' => 'Editer Actualite',
			'new_item' => 'Nouvel Actualite',
			'view_item' => 'Voir Actualite',
			'search_items' => 'Chercher',
			'not_found'           => 'Aucun résultat trouvé',
			'not_found_in_trash'  => 'Aucun résultat trouvé dans la corbeille',
			'parent_item_colon' => 'Parent Actualite'
			//'menu_name' => default to 'name'
		);
	
	$args = array(
		'label'               => 'Actus',
		 'description'         => 'Actus',
		'labels'              => $labels,
		'supports' => array(
			'title',
			'editor',
			'excerpt',
			//'author',
			//'trackbacks',
			//'custom-fields',
			//'comments',
			'revisions',
			'thumbnail',
			//'page-attributes', // (menu order, hierarchical must be true to show Parent option)
			//'post-formats',
		),
		'public'              => true,
		'has_archive'         => true,
		'taxonomies' => array( 'category' )
    );
	register_post_type( 'actualite', $args );

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