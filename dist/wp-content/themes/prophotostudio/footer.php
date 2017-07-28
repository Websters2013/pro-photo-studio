<?php
$socials = get_field('socials_list', 18);
if(!empty($socials)) {
	foreach ( $socials as $row ) {
		if((array_search('0', $row['show']) === false) || empty($row['image'])) {
			continue;
		}
		$socials_list .= '<!-- social__item --><a class="social__item" href="'.$row['url'].'" target="_blank">'.file_get_contents($row['image']).'</a><!-- /social__item -->';
	}
}

$menu_name = 'menu';
$locations = get_nav_menu_locations();
if( $locations && isset($locations[ $menu_name ]) ){

	$menu = wp_get_nav_menu_object( $locations[ $menu_name ] );
	$menu_items = wp_get_nav_menu_items( $menu );
	$menu_list = '<!-- footer__menu --><div class="footer__menu">';

	foreach ( (array) $menu_items as $key => $menu_item ){

		$perm = get_the_permalink($menu_item->object_id);
		$active = '';
		//var_dump($menu_item);
		if (is_page( $menu_item->object_id)) {
			$active = ' active';
		}

		$menu_list .= '<a class="footer__menu-item'.$active.'" href="'.$perm.'">'.$menu_item->title.'</a>';
	}

	$menu_list .= '</div><!-- /footer__menu -->';

}
?>
<!-- site__footer -->
<footer class="site__footer">

    <!-- footer__get-in-touch -->
    <div class="footer__get-in-touch">

        <?= $menu_list; ?>

        <!-- social -->
        <div class="social">

	        <?= $socials_list; ?>

        </div>
        <!-- /social -->

    </div>
    <!-- /footer__get-in-touch -->

    <div class="subscribe">
        <?= do_shortcode('[contact-form-7 id="92" title="Footer"]'); ?>
    </div>

    <span class="copyright"><?= get_field('copyright', 2); ?></span>

</footer>
<!-- /site__footer -->

</div>
<!-- /site -->

<?php wp_footer(); ?>

</body>
</html>
