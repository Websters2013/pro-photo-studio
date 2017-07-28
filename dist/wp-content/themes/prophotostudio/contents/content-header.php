<?php
$menu_name = 'menu';
$locations = get_nav_menu_locations();
$count_slash = 3;
$page_project = 'portfolio';

if( $locations && isset($locations[ $menu_name ]) ){

	$menu = wp_get_nav_menu_object( $locations[ $menu_name ] );
	$menu_items = wp_get_nav_menu_items( $menu );
	$menu_list = '<!-- menu --><nav class="menu"><div class="menu__wrap">';


	foreach ( (array) $menu_items as $key => $menu_item ){

		$perm = get_the_permalink($menu_item->object_id);
		$data_page = explode('/', $perm);

		$active = '';

		if (strlen($data_page[$count_slash]) == 2) {
			$count_slash++;
		}
		if (is_page( $menu_item->object_id ) || (is_singular($page_project) && $data_page[$count_slash] == $page_project)) {
			$active = ' active ';
		}

		$menu_list .= '<a href="' . $perm . '" data-page="' . $data_page[$count_slash] . '" class="menu__item'.$active.'">' . $menu_item->title . '</a>';
	}

	echo $menu_list .= '</div><!-- /menu__wrap --></nav><!-- /menu -->';

}
?>

<!-- lang -->
<div class="lang">
	<?php
		$languages = icl_get_languages('skip_missing=0&orderby=custom}');
		if(!empty($languages)){
			foreach($languages as $language){
				if($language['active']) {
					$start = '<span';
					$end = '</span>';
					$active = ' active';
				} else {
					$start = '<a href="'.$language['url'].'"';
					$end = '</a>';
					$active = '';
				}
				if($language['language_code'] != 'uk') {
				    $text = $code = $language['language_code'];
				} else {
				    $text = 'ua';
					$code = '';
                }
				$lang_string .= $start .' data-lang="'.$code.'" class="lang__item'.$active.'">'.$text.$end;
			}
			echo $lang_string;
		}
	?>
</div>
<!-- /lang -->