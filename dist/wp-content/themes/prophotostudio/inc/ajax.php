<?php
add_action('wp_ajax_gallery', 'gallery_ajax');
add_action('wp_ajax_nopriv_gallery', 'gallery_ajax');
function gallery_ajax() {
	$type = $_GET['type'];
	$page = $_GET['page'];

	if($type === 'all') {
		$type = '';
	}
	$args = array(
		'post_type'      => 'portfolio',
		'category_name' => $type,
		'paged' => $page,
		'posts_per_page' => 9,
		'orderby'        => 'menu_order',
		'post_status'    => 'publish',
		'fields'         => 'ids'
	);
	$query = new WP_Query();
	$posts = $query->query($args);

	$portfolio_items = '';
	if(!empty($posts)) {
		foreach ($posts as $row) {
			$class = implode(' ', wp_get_post_terms($row, 'portfolio', array('fields' => 'id=>slug', 'parent' => '0')));
			$portfolio_items .= '{"type": "all '.$class.'","dummy": "'.get_the_post_thumbnail_url($row).'","dummy_big": "'.get_field('image_overlay', $row).'"}, ';
		}
	}
	$portfolio_items = substr($portfolio_items,0, -2);
	if($query->max_num_pages < $page) {
		$has_items = 1;
	} else {
		$has_items = 0;
	}
	echo '{"has_items": '.$has_items.',"items":[
                        '.$portfolio_items.'
                    ]
                }';
	exit;
}