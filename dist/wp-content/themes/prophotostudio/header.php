<?php

$logo = get_field('logo', 2);
$logo = '<img src="'.$logo['url'].'" alt="'.$logo['alt'].'" title="'.$logo['title'].'">';
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
		if (is_page( $menu_item->object_id)) {
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
    <link rel="shortcut icon" href="<?= get_template_directory_uri().'/assets/img/favicon.ico'; ?>">
    <link rel="icon" sizes="16x16 32x32 64x64" href="<?= get_template_directory_uri().'/assets/img/favicon.ico'; ?>">
    <link rel="icon" type="image/png" sizes="196x196" href="<?= get_template_directory_uri().'/assets/img/favicon-192.png'; ?>">
    <link rel="icon" type="image/png" sizes="160x160" href="<?= get_template_directory_uri().'/assets/img/favicon-160.png'; ?>">
    <link rel="icon" type="image/png" sizes="96x96" href="<?= get_template_directory_uri().'/assets/img/favicon-96.png'; ?>">
    <link rel="icon" type="image/png" sizes="64x64" href="<?= get_template_directory_uri().'/assets/img/favicon-64.png'; ?>">
    <link rel="icon" type="image/png" sizes="32x32" href="<?= get_template_directory_uri().'/assets/img/favicon-32.png'; ?>">
    <link rel="icon" type="image/png" sizes="16x16" href="<?= get_template_directory_uri().'/assets/img/favicon-16.png'; ?>">
    <link rel="apple-touch-icon" href="<?= get_template_directory_uri().'/assets/img/favicon-57.png'; ?>">
    <link rel="apple-touch-icon" sizes="114x114" href="<?= get_template_directory_uri().'/assets/img/favicon-114.png'; ?>">
    <link rel="apple-touch-icon" sizes="72x72" href="<?= get_template_directory_uri().'/assets/img/favicon-72.png'; ?>">
    <link rel="apple-touch-icon" sizes="144x144" href="<?= get_template_directory_uri().'/assets/img/favicon-144.png'; ?>">
    <link rel="apple-touch-icon" sizes="60x60" href="<?= get_template_directory_uri().'/assets/img/favicon-60.png'; ?>">
    <link rel="apple-touch-icon" sizes="120x120" href="<?= get_template_directory_uri().'/assets/img/favicon-120.png'; ?>">
    <link rel="apple-touch-icon" sizes="76x76" href="<?= get_template_directory_uri().'/assets/img/favicon-76.png'; ?>">
    <link rel="apple-touch-icon" sizes="152x152" href="<?= get_template_directory_uri().'/assets/img/favicon-152.png'; ?>">
    <link rel="apple-touch-icon" sizes="180x180" href="<?= get_template_directory_uri().'/assets/img/favicon-180.png'; ?>">
    <meta name="msapplication-TileColor" content="#FFFFFF">
    <meta name="msapplication-TileImage" content="<?= get_template_directory_uri().'/assets/img/favicon-144.png'; ?>">
    <meta name="msapplication-config" content="<?= get_template_directory_uri().'/assets/img/browserconfig.xml'; ?>">
    <title>Title</title>

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
