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
		'public' => true,
		'show_ui' => true,
		'show_in_menu' => true,
		'show_in_admin_bar' => true,
		'can_export' => true,
		'has_archive' => false,
		'exclude_from_search' => true,
		'publicly_queryable' => true,
		'capability_type' => 'post',
		'rewrite' => array(
			'with_front' => true
		)
	);
	register_post_type('portfolio', $project_args);

	function tr_create_my_taxonomy() {
		register_taxonomy(
			'portfolio',
			'portfolio',
			array(
				'label' => __( 'Portfolio category' ),
				'hierarchical' => true,
			)
		);
	}
	add_action( 'init', 'tr_create_my_taxonomy' );

	$tehnology_labels = array(
		'name' => 'Tehnology',
		'singular_name' => 'Tehnology',
		'menu_name' => 'Tehnology',
		'all_items' => 'All Tehnology',
		'view_item' => 'View Tehnology',
		'add_new_item' => 'Add Tehnology',
		'add_new' => 'Add Tehnology',
		'edit_item' => 'Edit',
		'update_item' => 'Update',
		'search_items' => 'Search'
	);
	$tehnology_args = array(
		'labels' => $tehnology_labels,
		'supports' => array('title','thumbnail'),
		'hierarchical' => false,
		'public' => true,
		'show_ui' => true,
		'show_in_menu' => true,
		'show_in_admin_bar' => true,
		'can_export' => true,
		'has_archive' => false,
		'exclude_from_search' => true,
		'publicly_queryable' => true,
		'capability_type' => 'post',
		'rewrite' => array(
			'with_front' => true
		)
	);
	register_post_type('tehnology', $tehnology_args);



}
