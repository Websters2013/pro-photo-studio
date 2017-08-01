<?php
/*
Template Name: 360
*/
 get_header();
$post_id = 183;
$promo_amazon_image = get_field('promo_amazon_image', $post_id);
$button_offside = get_field('button_offside', $post_id);
$promo_slider = get_field('promo_slider', $post_id);
if($promo_slider) {
    foreach ($promo_slider as $row) {
       $promo_slider_string .= '<div class="promo__slide swiper-slide">
                        <img src="'.$row['image']['url'].'" alt="'.$row['image']['alt'].'" title="'.$row['image']['title'].'"/>
                    </div>';
    }
}
?>

    <!-- promo -->
    <article class="promo article">

        <a href="<?= get_permalink(8); ?>" class="promo__back"><?= get_field('button_title_back', 8); ?></a>

        <h1><?= get_post_field('post_content', $post_id); ?></h1>

        <div class="promo__preface">
	        <?= get_field('promo_preface', $post_id ); ?>
        </div>

        <div class="promo__amazon">
            <span><?= get_field('promo_amazon', $post_id ); ?></span>
            <img src="<?= $promo_amazon_image['url']; ?>" alt="<?= $promo_amazon_image['alt']; ?>" title="<?= $promo_amazon_image['title']; ?>"/>
        </div>

	    <?= get_field('promo_content', $post_id ); ?>

        <?php if($promo_slider_string) {?>
        <!-- promo -->
        <div class="promo__slider">

            <div class="promo__swiper swiper-container">

                <div class="swiper-wrapper">

                    <?= $promo_slider_string; ?>

                </div>

            </div>

            <div class="promo__swiper-prev"></div>
            <div class="promo__swiper-next"></div>

        </div>
        <!-- /promo -->
        <?php } ?>

        <?= get_field('offside_footer', $post_id); ?>

        <p><a href="<?= $button_offside['url']; ?>" class="promo__order"><?= $button_offside['title']; ?></a></p>

    </article>
    <!-- /promo -->

<?php get_footer(); ?>