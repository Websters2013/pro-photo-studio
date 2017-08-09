<?php

$logo = get_field('logo', 2);
$logo = '<img src="'.$logo['url'].'" alt="'.$logo['alt'].'" title="'.$logo['title'].'">';

$hero_image_other_page = get_field('background');
if(is_page_template('page-services-single.php')) {

	$term = get_term_by('slug', $_GET['category'], 'portfolio');
	
	$hero_image_other_page = get_field('background', 'portfolio_'.$term->term_id);
}
$hero_image_other_page = '<img src="'.$hero_image_other_page['url'].'" alt="'.$hero_image_other_page['alt'].'" title="'.$hero_image_other_page['title'].'">';
if(is_front_page()) {
	$logo = '<!-- logo --><h1 class="logo">'.$logo.'</h1><!-- /logo -->';
} else {
	$logo = '<!-- logo --><a href="'.get_site_url().'" class="logo">'.$logo.'</a><!-- /logo -->';
}

$socials = get_field('socials_list', 18);
if(!empty($socials)) {
	foreach ( $socials as $row ) {
		if((array_search('0', $row['show']) === false) || empty($row['image'])) {
			continue;
		}
		$socials_list .= '<!-- social__item --><a class="social__item" href="'.$row['url'].'" target="_blank">'.file_get_contents($row['image']).'</a><!-- /social__item -->';
	}
}

$hero_image =  get_field('hero_image', 2);

function is_tree( $pid ){
	global $post;

	// если мы уже на указанной странице выходим
	if ( is_page( $pid ) )
		return true;

	$anc = get_post_ancestors( $post->ID );
	foreach ( $anc as $ancestor ) {
		if( is_page() && $ancestor == $pid ) {
			return true;
		}
	}

	return false;
}
$menu_name = 'menu';
$locations = get_nav_menu_locations();
if( $locations && isset($locations[ $menu_name ]) ){

	$menu = wp_get_nav_menu_object( $locations[ $menu_name ] );
	$menu_items = wp_get_nav_menu_items( $menu );
	$menu_list = '<!-- menu --><nav class="menu">';

	foreach ( (array) $menu_items as $key => $menu_item ){

		$perm = get_the_permalink($menu_item->object_id);
		$active = '';
		//var_dump($menu_item);
		if (is_page( $menu_item->object_id) || is_tree($menu_item->object_id)) {
			$active = ' active';
		}

		$menu_list .= '<a class="menu__item'.$active.'" href="'.$perm.'">'.$menu_item->title.'</a>';
	}

	$menu_list .= '</nav><!-- /menu -->';

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="robots" content="noindex, nofollow">
    <meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="format-detection" content="telephone=no">
    <meta name="format-detection" content="address=no">
    <title>Title</title>
    <?php if(is_single()) { ?>
        <meta property="og:title" content="<?= get_the_title($post->ID); ?>"/>
        <meta property="og:description" content="<?= get_field('excerpt', $post->ID); ?> "/>
        <meta property="og:image" content="<?= get_the_post_thumbnail_url($post->ID); ?>">
        <meta property="og:type" content="article"/>
        <meta property="og:url" content= "<?= get_permalink($post->ID); ?>" />
    <?php } ?>

<?php wp_head(); ?>
</head>
<body data-action="<?php echo admin_url( 'admin-ajax.php' );?>">

<!-- site -->
<div class="site">

    <!-- site__header -->
    <div class="site__header">

        <?= $logo; ?>

        <!-- mobile-menu -->
        <div class="mobile-menu">

            <?= $menu_list; ?>

            <!-- social -->
            <div class="social">

                <?= $socials_list; ?>

            </div>
            <!-- /social -->

        </div>
        <!-- /mobile-menu -->

        <!-- menu-mobile-btn -->
        <div class="mobile-menu-btn">
            <span></span>
        </div>
        <!-- /menu-mobile-btn -->

      <?php if(!is_front_page()) { ?>
          <div class="header__promo">
             <?= $hero_image_other_page; ?>
          </div>
      <?php } ?>

    </div>
    <!-- /site__header -->



    <?php if(is_front_page()) { ?>

    <!-- hero -->
    <div class="hero">

        <!-- hero__person -->
        <div class="hero__person">

            <img src="<?= $hero_image['url']; ?>" alt="<?= $hero_image['alt']; ?>" title="<?= $hero_image['title']; ?>">

            <!-- hero__person-info -->
            <div class="hero__person-info">
                <?= get_field('hero_titles', 2); ?>
            </div>
            <!-- /hero__person-info -->

        </div>
        <!-- /hero__person -->

        <!-- hero__content -->
        <div class="hero__content">
	        <?= get_field('hero_content', 2); ?>
        </div>
        <!-- /hero__content -->

    </div>
    <!-- /hero -->

    <?php  } ?>
