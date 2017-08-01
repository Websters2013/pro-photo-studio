<?php
/*
Template Name: Services single
*/
 get_header();
 $category = $_GET['category'];
 $category = get_term_by('slug', $category, 'portfolio');

$sub_term = get_term_children($category->term_id, 'portfolio');
if(!empty($sub_term)) {
	$hidden = ' hidden';
}
$switcher = '<button class="media-gallery__check active" data-type="'.$category->slug.'">All</button>';
if($sub_term) {
    foreach ($sub_term as $row) {
	    $term = get_term_by( 'id', $row, 'portfolio' );
	    $switcher .= '<button class="media-gallery__check" data-type="'.$term->slug.'">'.$term->name.'</button>';
    }
}
 ?>

    <!-- media-gallery -->
    <section class="media-gallery" data-loaded-group="0" data-loaded-type="all">

        <a href="<?= get_permalink(8); ?>" class="media-gallery__back"><?= get_field('button_title_back', 8); ?></a>

        <!-- media-gallery__preface -->
        <div class="media-gallery__preface">

            <h1 class="media-gallery__title"><?= $category->name; ?></h1>

            <?php if($category->description) {?>
            <p><?= $category->description; ?></p>
            <?php } ?>

        </div>
        <!-- /media-gallery__preface -->

        <!-- media-gallery__switcher -->
        <div class="media-gallery__switcher <?= $hidden; ?>">
            <?= $switcher; ?>

        </div>
        <!-- /media-gallery__switcher -->

        <!-- media-gallery__cover -->
        <div class="media-gallery__cover">

            <!--media-gallery__inner-->
            <div class="media-gallery__wrap">

                <div class="media-gallery__sizer"></div>

            </div>
            <!--/media-gallery__inner-->

        </div>
        <!-- /media-gallery__cover -->

        <!--preloader-->
        <div class="preloader">

            <!--preloader__inner-->
            <span class="preloader__inner">

                    <!--preloader__item-->
                    <span class="preloader__item"></span>
                <!--/preloader__item-->

                </span>
            <!--/preloader__inner-->

        </div>
        <!--/preloader-->

        <!-- btn -->
        <a href="#" class="media-gallery__more"><?= get_field('title_button_portfolio', 2); ?></a>
        <!-- /btn -->

    </section>
    <!-- /media-gallery -->

<?php get_footer(); ?>