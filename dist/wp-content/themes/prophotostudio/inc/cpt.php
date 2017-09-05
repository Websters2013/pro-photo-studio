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

	function tr_create_my_taxonomy() {
		register_taxonomy(
			'portfolio',
			 array('portfolio'),
			array(
				'label' => __( 'Portfolio category' ),
				'public' => true,
				'show_ui'=>true,
				'hierarchical' => true,
			)
		);
	}
	add_action( 'init', 'tr_create_my_taxonomy' );




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




/*
function pippin_add_taxonomy_filters() {
	global $typenow;
 
	// an array of all the taxonomyies you want to display. Use the taxonomy name or slug
	$taxonomies = array('portfolio');
 
	// must set this to the post type you want the filter(s) displayed on
	if( $typenow == 'portfolio' ){
 
		foreach ($taxonomies as $tax_slug) {
			$tax_obj = get_taxonomy($tax_slug);
			$tax_name = $tax_obj->labels->name;
			$terms = get_terms($tax_slug);
			if(count($terms) > 0) {
				echo "<select name='$tax_slug' id='$tax_slug' class='postform'>";
				echo "<option value=''>Show All $tax_name</option>";
				foreach ($terms as $term) { 
					echo '<option value='. $term->slug, $_GET[$tax_slug] == $term->slug ? ' selected="selected"' : '','>' . $term->name .' (' . $term->count .')</option>'; 
				}
				echo "</select>";
			}
		}
	}
}
add_action( 'restrict_manage_posts', 'pippin_add_taxonomy_filters' );*/


if (!class_exists('Tax_CTP_Filter')){
  /**
	* Tax CTP Filter Class 
	* Simple class to add custom taxonomy dropdown to a custom post type admin edit list
	* @author Ohad Raz <admin@bainternet.info>
	* @version 0.1
	*/
	class Tax_CTP_Filter
	{
		/**
		 * __construct 
		 * @author Ohad Raz <admin@bainternet.info>
		 * @since 0.1
		 * @param array $cpt [description]
		 */
		function __construct($cpt = array()){
			$this->cpt = $cpt;
			// Adding a Taxonomy Filter to Admin List for a Custom Post Type
			add_action( 'restrict_manage_posts', array($this,'my_restrict_manage_posts' ));
		}
		/**
		 * my_restrict_manage_posts  add the slelect dropdown per taxonomy
		 * @author Ohad Raz <admin@bainternet.info>
		 * @since 0.1
		 * @return void
		 */
		public function my_restrict_manage_posts() {
		    // only display these taxonomy filters on desired custom post_type listings
		    global $typenow;
		    $types = array_keys($this->cpt);
		    if (in_array($typenow, $types)) {
		        // create an array of taxonomy slugs you want to filter by - if you want to retrieve all taxonomies, could use get_taxonomies() to build the list
		        $filters = $this->cpt[$typenow];
		        foreach ($filters as $tax_slug) {
		            // retrieve the taxonomy object
		            $tax_obj = get_taxonomy($tax_slug);
		            $tax_name = $tax_obj->labels->name;
		            // output html for taxonomy dropdown filter
		            echo "<select name='".strtolower($tax_slug)."' id='".strtolower($tax_slug)."' class='postform'>";
		            echo "<option value=''>Show All $tax_name</option>";
		            $this->generate_taxonomy_options($tax_slug,0,0,(isset($_GET[strtolower($tax_slug)])? $_GET[strtolower($tax_slug)] : null));
		            echo "</select>";
		        }
		    }
		}
		
		/**
		 * generate_taxonomy_options generate dropdown
		 * @author Ohad Raz <admin@bainternet.info>
		 * @since 0.1
		 * @param  string  $tax_slug 
		 * @param  string  $parent   
		 * @param  integer $level    
		 * @param  string  $selected 
		 * @return void            
		 */
		public function generate_taxonomy_options($tax_slug, $parent = '', $level = 0,$selected = null) {
		    $args = array('show_empty' => 1);
		    if(!is_null($parent)) {
		        $args = array('parent' => $parent);
		    }
		    $terms = get_terms($tax_slug,$args);
		    $tab='';
		    for($i=0;$i<$level;$i++){
		        $tab.='--';
		    }
		    foreach ($terms as $term) {
		        // output each select option line, check against the last $_GET to show the current option selected
		        echo '<option value='. $term->slug, $selected == $term->slug ? ' selected="selected"' : '','>' .$tab. $term->name .' (' . $term->count .')</option>';
		        $this->generate_taxonomy_options($tax_slug, $term->term_id, $level+1,$selected);
		    }
		}
	}//end class
}//end if

//usage:
new Tax_CTP_Filter(array(
	'portfolio' => array('portfolio_cat')
	)
);