<?php
$menu_name = 'sub_menu';
$locations = get_nav_menu_locations();
if( $locations && isset($locations[ $menu_name ]) ){

	$menu = wp_get_nav_menu_object( $locations[ $menu_name ] );
	$menu_items = wp_get_nav_menu_items( $menu );
	$menu_list = '<!-- swiper-wrapper --><div class="swiper-wrapper">';

	foreach ( (array) $menu_items as $key => $menu_item ){

		$perm = get_the_permalink($menu_item->object_id);
		$active = '';
		//var_dump($menu_item);
		if (is_page( $menu_item->object_id)) {
			$active = ' active';
		}

		$menu_list .= '<a class="sub-menu__item swiper-slide'.$active.'" href="'.$perm.'">'.$menu_item->title.'</a>';
	}

	$menu_list .= '</div><!-- /swiper-wrapper -->';

}
?>
<!-- sub-menu -->
<div class="sub-menu">

	<!-- swiper-wrapper -->
	<div class="sub-menu__swiper swiper-container">

		<!-- swiper-wrapper -->
		<div class="swiper-wrapper">

        <?= $menu_list; ?>

		</div>
		<!-- /swiper-wrapper -->

	</div>

</div>
<!-- /sub-menu -->