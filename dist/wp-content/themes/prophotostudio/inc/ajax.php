<?php
add_action('wp_ajax_gallery', 'gallery_ajax');
add_action('wp_ajax_nopriv_gallery', 'gallery_ajax');
function gallery_ajax() {
	$type = $_GET['type'];
	$page = $_GET['page']+1;

	$posts_per_page = 9;
	if($type === 'headshot') {
		$posts_per_page = 6;
	}
	if($type === 'all' || $type === '') {
		$categories = get_field('show_category', 2);
		foreach ($categories as $row) {
			$categories_arr[] = $row->slug;
		}
		$args = array(
			'post_type'      => 'portfolio',
			'paged' => $page,
			'posts_per_page' => $posts_per_page,
			'orderby'        => 'menu_order',
			'post_status'    => 'publish',
			'fields'         => 'ids',
			'tax_query' => array(
				array(
					'taxonomy' => 'portfolio',
					'field'    => 'slug',
					'terms'    => $categories_arr,
				)
			)
		);
	} else {
		$args = array(
			'post_type'      => 'portfolio',
			'paged' => $page,
			'posts_per_page' => $posts_per_page,
			'orderby'        => 'menu_order',
			'post_status'    => 'publish',
			'fields'         => 'ids',
			'tax_query' => array(
				array(
					'taxonomy' => 'portfolio',
					'field'    => 'slug',
					'terms'    => $type,
				)
			)
		);
	}

	$query = new WP_Query();
	$posts = $query->query($args);

	$portfolio_items = '';
	if(!empty($posts)) {
		foreach ($posts as $row) {
			$class = implode(' ', wp_get_post_terms($row, 'portfolio', array('fields' => 'id=>slug', )));
			$image = get_field('image', $row)['url'];
			$image_overlay = get_field('image_overlay', $row)['url'];
			$video = get_field('project_show', $row);
			if($video === '1') {
				$image_overlay = get_field('video', $row, false, false);
				$image = explode('/', $image_overlay);
				$image = 'http://img.youtube.com/vi/'.$image[count($image)-1].'/maxresdefault.jpg';
			}
			$portfolio_items .= '{"type": "all '.$class.'","dummy": "'.$image.'","dummy_big": "'.$image_overlay.'","title": "'.get_field('title_overlay', $row).'","video": "'.$video.'"}, ';
		}
	}
	$portfolio_items = substr($portfolio_items,0, -2);
	if($query->max_num_pages > $page) {
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