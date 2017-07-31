<?php
/*
Template Name: About
*/
 get_header();
 get_template_part('contents/content', 'submenu');
$post_id = 6;
$slider_string = '';
$slider = get_field('slider', $post_id);
if($slider) {
    foreach ($slider as $row) {
       $slider_string .= '<div class="catalog__slide swiper-slide"><img src="'.$row['image']['url'].'" alt="'.$row['image']['alt'].'" title="'.$row['image']['title'].'"/></div>';
    }
}
?>

    <!-- about-us -->
    <article class="about-us">

        <h1><?= get_field('title_content', $post_id); ?></h1>

        <!-- about-us__content -->
        <div class="article about-us__content">
	        <?= get_post_field('post_content', $post_id); ?>
        </div>
        <!-- /about-us__content -->

        <!-- about-us__img -->
        <div class="about-us__img">
            <img src="<?= get_the_post_thumbnail_url($post_id, 'full'); ?>" alt="img"/>
        </div>
        <!-- /about-us__img -->

    </article>
    <!-- /about-us -->

    <!-- catalog -->
    <div class="catalog">

        <div class="catalog__swiper-prev"></div>

        <div class="catalog__swiper swiper-container">

            <div class="swiper-wrapper">

                <?= $slider_string; ?>

            </div>

        </div>

        <div class="catalog__swiper-next"></div>

    </div>
    <!-- /catalog -->

<?php get_footer(); ?>