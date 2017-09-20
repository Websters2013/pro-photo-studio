<?php
// Register Custom Post Type
add_action('init', 'custom_post_type', 0);

function custom_post_type() {
	$project_labels = array(
		'name' => 'Portfolio',
		'singular_name' => 'Portfolio',
		'menu_name' => 'Portfolio',
		'all_items' => 'All Projects',
		'view_item' => 'View Project',
		'add_new_item' => 'Add Project',
		'add_new' => 'Add Project',
		'edit_item' => 'Edit',
		'update_item' => 'Update',
		'search_items' => 'Search'
	);
	$project_args = array(
		'labels' => $project_labels,
		'supports' => array('title','thumbnail','editor'),
		'hierarchical' => false,
		'taxonomies' => 'portfolio',
		'public' => true,
		'show_ui' => true,
		'show_in_menu' => true,
		'show_in_admin_bar' => true,
		'can_export' => true,
		'has_archive' => false,
		'exclude_from_search' => false,
		'publicly_queryable' => true,
		'capability_type' => 'post',
		'rewrite' => array(
			'with_front' => true
		)
	);
	register_post_type('portfolio', $project_args);

	function create_taxonomy_porfolio_cat() {
		register_taxonomy(
			'portfolio_cat',
			 array('portfolio'),
			array(
				'label' => __( 'Portfolio categories' ),
				'public' => true,
				'show_ui'=>true,
				'hierarchical' => true,
			)
		);
	}
	add_action( 'init', 'create_taxonomy_porfolio_cat' );


flush_rewrite_rules();
}



